<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Church;
use App\Models\District;
use App\Models\Locality;
use App\Models\User;
use App\Support\ModelLabel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/** Reference lists for the app's pickers and filters. */
class LookupController extends Controller
{
    /** GET /lookups: localities, districts and churches. */
    public function index(): JsonResponse
    {
        $localities = Locality::query()->get()
            ->map(fn (Locality $locality) => [
                'id' => $locality->id,
                'name' => ModelLabel::of($locality, ModelLabel::LOCALITY) ?? "Locality #{$locality->id}",
            ])
            ->sortBy(fn (array $row) => mb_strtolower($row['name']))
            ->values();

        $districts = District::query()->get()
            ->map(fn (District $district) => [
                'id' => $district->id,
                'name' => ModelLabel::of($district, ModelLabel::DISTRICT) ?? "District #{$district->id}",
                // Null when the districts table has no locality_id column.
                'locality_id' => $district->getAttributes()['locality_id'] ?? null,
            ])
            ->sortBy(fn (array $row) => mb_strtolower($row['name']))
            ->values();

        $churches = Church::query()
            ->orderBy('church_name')
            ->get(['id', 'church_name', 'church_code'])
            ->map(fn (Church $church) => [
                'id' => $church->id,
                'name' => $church->church_name,
                'code' => $church->church_code,
            ])
            ->values();

        return response()->json([
            'data' => [
                'localities' => $localities,
                'districts' => $districts,
                'churches' => $churches,
            ],
        ]);
    }

    /** GET /lookups/available-users: Member accounts that are not linked to a member yet. */
    public function availableUsers(): JsonResponse
    {
        $linked = DB::table('members')->whereNull('deleted_at')->select('user_id');

        $users = User::query()
            ->where('role', 'Member')
            ->whereNotIn('id', $linked)
            ->orderBy('name')
            ->limit(500)
            ->get(['id', 'name', 'email'])
            ->map(fn (User $user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ])
            ->values();

        return response()->json(['data' => $users]);
    }
}
