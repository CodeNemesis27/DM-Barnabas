<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MemberController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'church_id' => ['nullable', 'integer', 'exists:churches,id'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:50'],
        ]);

        // "juan cruz" becomes ["juan", "cruz"]; every word has to match something.
        $terms = preg_split('/\s+/', trim($filters['search'] ?? ''), -1, PREG_SPLIT_NO_EMPTY);

        $members = Member::query()
            ->with('church:id,church_code,church_name,type')
            ->when($filters['church_id'] ?? null, fn($query, $churchId) => $query->where('church_id', $churchId))
            ->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('first_name', 'like', "%{$term}%")
                            ->orWhere('middle_name', 'like', "%{$term}%")
                            ->orWhere('last_name', 'like', "%{$term}%")
                            ->orWhere('phone_no', 'like', "%{$term}%");
                    });
                }
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate($filters['per_page'] ?? 15);

        return MemberResource::collection($members);
    }
}
