<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Locality;
use App\Support\ModelLabel;
use Illuminate\Http\JsonResponse;

/** Localities and districts for the app's pickers and filters. */
class LookupController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $localities = Locality::query()->get()
            ->map(fn(Locality $locality) => [
                'id' => $locality->id,
                'name' => ModelLabel::of($locality, ModelLabel::LOCALITY) ?? "Locality #{$locality->id}",
            ])
            ->sortBy(fn(array $row) => mb_strtolower($row['name']))
            ->values();

        $districts = District::query()->get()
            ->map(fn(District $district) => [
                'id' => $district->id,
                'name' => ModelLabel::of($district, ModelLabel::DISTRICT) ?? "District #{$district->id}",
                // Null when the districts table has no locality_id column.
                'locality_id' => $district->getAttributes()['locality_id'] ?? null,
            ])
            ->sortBy(fn(array $row) => mb_strtolower($row['name']))
            ->values();

        return response()->json([
            'data' => [
                'localities' => $localities,
                'districts' => $districts,
            ],
        ]);
    }
}
