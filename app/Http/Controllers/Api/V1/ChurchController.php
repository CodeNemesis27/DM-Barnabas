<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ChurchRequest;
use App\Http\Resources\ChurchResource;
use App\Models\Church;
use App\Models\Member;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ChurchController extends Controller
{
    /** GET /churches?search=&type=&locality_id=&district_id=&page=&per_page= */
    public function index(Request $request): AnonymousResourceCollection
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'type' => ['nullable', Rule::in(['Church', 'Company'])],
            'locality_id' => ['nullable', 'integer'],
            'district_id' => ['nullable', 'integer'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:50'],
        ]);

        // Escape LIKE wildcards so a typed "%" or "_" is matched literally.
        $search = filled($filters['search'] ?? null)
            ? addcslashes(trim($filters['search']), '%_\\')
            : null;

        $churches = Church::query()
            ->with(['locality', 'district'])
            ->when($search, function (Builder $query, string $search) {
                $query->where(function (Builder $query) use ($search) {
                    $query->whereLike('church_name', "%{$search}%")
                        ->orWhereLike('church_code', "%{$search}%");
                });
            })
            ->when($filters['type'] ?? null, fn(Builder $query, string $type) => $query->where('type', $type))
            ->when($filters['locality_id'] ?? null, fn(Builder $query, $id) => $query->where('locality_id', $id))
            ->when($filters['district_id'] ?? null, fn(Builder $query, $id) => $query->where('district_id', $id))
            ->orderBy('church_name')
            ->paginate($filters['per_page'] ?? 15)
            ->withQueryString();

        return ChurchResource::collection($churches);
    }

    public function show(Church $church): ChurchResource
    {
        return new ChurchResource($church->loadMissing(['locality', 'district']));
    }

    public function store(ChurchRequest $request): JsonResponse
    {
        $church = new Church;
        // forceFill: the data is already validated, so it does not depend on the model's $fillable list.
        $church->forceFill($request->validated())->save();

        return (new ChurchResource($church->load(['locality', 'district'])))
            ->response()
            ->setStatusCode(201);
    }

    public function update(ChurchRequest $request, Church $church): ChurchResource
    {
        $church->forceFill($request->validated())->save();

        return new ChurchResource($church->load(['locality', 'district']));
    }

    public function destroy(Church $church): JsonResponse|Response
    {
        // Members point at their church, so a church that still has members must not disappear.
        $members = Member::query()->where('church_id', $church->id)->count();

        if ($members > 0) {
            return response()->json([
                'message' => "This church still has {$members} " . Str::plural('member', $members) . '. Move or remove them before deleting it.',
            ], 409);
        }

        $church->delete();

        return response()->noContent();
    }
}
