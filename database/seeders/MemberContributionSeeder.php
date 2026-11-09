<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\MemberContribution;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberContributionSeeder extends Seeder
{
    public function run(): void
    {
        $members = Member::query()
            ->where('status', 'Active')
            ->orderBy('id')
            ->get();

        if ($members->isEmpty()) {
            $this->command?->warn('No Active members found. Run MemberSeeder first.');

            return;
        }

        // Fixed months so re-running the seeder never creates new reference numbers.
        $months = [
            ['year' => 2026, 'month' => 8],
            ['year' => 2026, 'month' => 9],
            ['year' => 2026, 'month' => 10],
        ];

        $amounts = [100.00, 150.00, 200.00, 300.00];
        $paymentMethods = ['Cash', 'GCash'];
        $statusPattern = ['Approved', 'Approved', 'Approved', 'Approved', 'Submitted', 'Rejected'];

        DB::transaction(function () use ($members, $months, $amounts, $paymentMethods, $statusPattern) {
            foreach ($members as $member) {
                foreach ($months as $monthIndex => $period) {
                    $status = $statusPattern[($member->id + $monthIndex) % count($statusPattern)];

                    // Only the latest month can still be waiting for review.
                    if ($status === 'Submitted' && $monthIndex < count($months) - 1) {
                        $status = 'Approved';
                    }

                    $paidAt = Carbon::create($period['year'], $period['month'], 5 + ($member->id % 20), 9, 0, 0);

                    $refNo = sprintf('CON-%04d%02d-%05d', $period['year'], $period['month'], $member->id);

                    MemberContribution::unguarded(function () use (
                        $member,
                        $monthIndex,
                        $refNo,
                        $status,
                        $paidAt,
                        $amounts,
                        $paymentMethods
                    ) {
                        MemberContribution::updateOrCreate(
                            ['contribution_ref_no' => $refNo],
                            [
                                'member_id' => $member->id,
                                'payment_method' => $paymentMethods[($member->id + $monthIndex) % count($paymentMethods)],
                                'amount' => $amounts[$member->id % count($amounts)],
                                'status' => $status,
                                'approved_by' => $status === 'Approved' ? 1 : null,
                                'approved_at' => $status === 'Approved' ? $paidAt->copy()->addDay() : null,
                                'created_by' => 1,
                                'created_at' => $paidAt,
                                'updated_at' => $paidAt,
                            ],
                        );
                    });
                }
            }
        });
    }
}
