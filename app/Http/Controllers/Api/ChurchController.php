<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChurchResource;
use App\Models\Church;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

class ChurchController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'type' => ['nullable', Rule::in(['Church', 'Company'])],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:50'],
        ]);

        $churches = Church::query()
            ->withCount('members')
            ->when($filters['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('church_name', 'like', "%{$search}%")
                        ->orWhere('church_code', 'like', "%{$search}%");
                });
            })
            ->when($filters['type'] ?? null, fn($query, string $type) => $query->where('type', $type))
            ->orderBy('church_name')
            ->paginate($filters['per_page'] ?? 15);

        // Totals for the filter chips. These ignore the search box on purpose.
        $counts = Church::query()
            ->selectRaw('type, COUNT(*) as aggregate')
            ->groupBy('type')
            ->pluck('aggregate', 'type');

        return ChurchResource::collection($churches)->additional([
            'summary' => [
                'total' => (int) $counts->sum(),
                'churches' => (int) ($counts['Church'] ?? 0),
                'companies' => (int) ($counts['Company'] ?? 0),
            ],
        ]);
    }
}
