<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\MemberRequest;
use App\Http\Resources\MemberResource;
use App\Models\DeathRecord;
use App\Models\Member;
use App\Models\MemberContribution;
use App\Models\User;
use App\Support\PersonName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    /** GET /members?search=&status=&class=&gender=&church_id=&page=&per_page= */
    public function index(Request $request): AnonymousResourceCollection
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', Rule::in(['Active', 'Deceased'])],
            'class' => ['nullable', Rule::in(['A', 'B'])],
            'gender' => ['nullable', Rule::in(['Male', 'Female'])],
            'church_id' => ['nullable', 'integer'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:50'],
        ]);

        // Every word that was typed has to match the first, middle or last name, or the phone number.
        $terms = preg_split('/\s+/', trim($filters['search'] ?? ''), -1, PREG_SPLIT_NO_EMPTY) ?: [];

        $members = Member::query()
            ->with('church')
            ->when($terms !== [], function (Builder $query) use ($terms) {
                foreach (array_slice($terms, 0, 5) as $term) {
                    // Escape LIKE wildcards so a typed "%" or "_" is matched literally.
                    $like = '%'.addcslashes($term, '%_\\').'%';

                    $query->where(function (Builder $query) use ($like) {
                        $query->whereLike('first_name', $like)
                            ->orWhereLike('middle_name', $like)
                            ->orWhereLike('last_name', $like)
                            ->orWhereLike('phone_no', $like);
                    });
                }
            })
            ->when($filters['status'] ?? null, fn (Builder $query, string $status) => $query->where('status', $status))
            ->when($filters['class'] ?? null, fn (Builder $query, string $class) => $query->where('class', $class))
            ->when($filters['gender'] ?? null, fn (Builder $query, string $gender) => $query->where('gender', $gender))
            ->when($filters['church_id'] ?? null, fn (Builder $query, $churchId) => $query->where('church_id', $churchId))
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->orderBy('id')
            ->paginate($filters['per_page'] ?? 20)
            ->withQueryString();

        return MemberResource::collection($members);
    }

    public function show(Member $member): MemberResource
    {
        return new MemberResource($member->load(['church', 'user']));
    }

    public function store(MemberRequest $request): JsonResponse
    {
        $data = $request->memberData();

        // The account and the member are created together, or not at all.
        $member = DB::transaction(function () use ($request, $data) {
            $userId = $request->input('account_mode') === 'existing'
                ? (int) $request->input('user_id')
                : $this->createAccount($request, $data)->id;

            $member = new Member;
            // forceFill: the data is already validated, so it does not depend on the model's $fillable list.
            $member->forceFill($data + ['user_id' => $userId, 'created_by' => $request->user()->id])->save();

            return $member;
        });

        return (new MemberResource($member->load(['church', 'user'])))
            ->response()
            ->setStatusCode(201);
    }

    public function update(MemberRequest $request, Member $member): MemberResource
    {
        $member->forceFill($request->memberData())->save();

        return new MemberResource($member->load(['church', 'user']));
    }

    public function destroy(Member $member): JsonResponse|Response
    {
        // Contributions and death records point at the member, so a member that has them must stay.
        $hasRecords = MemberContribution::query()->where('member_id', $member->id)->exists()
            || DeathRecord::query()->where('member_id', $member->id)->exists();

        if ($hasRecords) {
            return response()->json([
                'message' => 'This member already has contribution or death records, so it can’t be deleted.',
            ], 409);
        }

        $member->delete();

        return response()->noContent();
    }

    /** @param  array<string, mixed>  $data  The validated member columns. */
    private function createAccount(MemberRequest $request, array $data): User
    {
        $user = new User;
        $user->forceFill([
            'name' => PersonName::short($data['first_name'], $data['last_name'], $data['suffix'] ?? null),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'Member',
            'email_verified_at' => now(),
        ]);

        // An account created by staff counts as approved (the web login holds back unapproved accounts).
        if (Schema::hasColumns('users', ['approved_by', 'approved_at'])) {
            $user->forceFill(['approved_by' => $request->user()->id, 'approved_at' => now()]);
        }

        $user->save();

        return $user;
    }
}
