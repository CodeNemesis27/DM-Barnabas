<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\Member;
use App\Models\MemberContribution;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function __invoke(): JsonResponse
    {
        // "This month" follows the fund's local calendar, while timestamps are stored in app.timezone.
        $now = now(config('fund.timezone'));
        $monthStart = $now->copy()->startOfMonth()->setTimezone(config('app.timezone'));
        $nextMonthStart = $now->copy()->startOfMonth()->addMonth()->setTimezone(config('app.timezone'));

        $cashAid = (float) config('fund.cash_aid_per_claim');

        // Date a claim was requested (honours a renamed created_at, e.g. date_requested).
        $requestedAt = (new Claim)->getCreatedAtColumn();

        // Money in: only contributions that staff have approved count towards the fund.
        $totalContributions = (float) MemberContribution::query()
            ->where('status', 'Approved')
            ->sum('amount');

        // Money out: the claims table has no amount column, so every Disbursed claim releases the
        // standard cash aid. Disbursed claims have no disbursed_at column either, so updated_at (the
        // moment the status was last changed) is used as the disbursement date.
        $overallDisbursedClaims = Claim::query()->where('status', 'Disbursed')->count();
        $disbursedThisMonthClaims = Claim::query()
            ->where('status', 'Disbursed')
            ->where('updated_at', '>=', $monthStart)
            ->where('updated_at', '<', $nextMonthStart)
            ->count();

        $overallDisbursed = $overallDisbursedClaims * $cashAid;

        return response()->json([
            'data' => [
                'total_available_balance' => round($totalContributions - $overallDisbursed, 2),
                'total_contributions' => round($totalContributions, 2),
                'this_month_claims' => Claim::query()
                    ->where($requestedAt, '>=', $monthStart)
                    ->where($requestedAt, '<', $nextMonthStart)
                    ->count(),
                'active_members' => Member::query()->where('status', 'Active')->count(),
                'deceased_members' => Member::query()->where('status', 'Deceased')->count(),
                'pending_claims' => Claim::query()->where('status', 'Pending')->count(),
                'disbursed_this_month' => round($disbursedThisMonthClaims * $cashAid, 2),
                'overall_disbursed_amount' => round($overallDisbursed, 2),
                'month_label' => $now->format('F Y'),
                'generated_at' => $now->toIso8601String(),
            ],
        ]);
    }
}
