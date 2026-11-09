<?php

namespace Database\Seeders;

use App\Models\Claim;
use App\Models\DeathRecord;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClaimSeeder extends Seeder
{
    public function run(): void
    {
        $deathRecords = DeathRecord::query()->orderBy('id')->get();

        if ($deathRecords->isEmpty()) {
            $this->command?->warn('No death records found. Run DeathRecordSeeder first.');

            return;
        }

        // claimant name, relationship, phone, status
        $claims = [
            ['Maria Dela Cruz', 'Spouse', '09171234601', 'Disbursed'],
            ['Roberto Dela Cruz', 'Son', '09061234602', 'Rejected'],
            ['Carmela Santos', 'Daughter', '09151234603', 'Approved'],
            ['Elena Garcia', 'Sibling', '09261234604', 'Pending'],
            ['Pedro Mendoza', 'Brother', '09351234605', 'Cancelled'],
            ['Teresita Ramos', 'Spouse', '09451234606', 'Disbursed'],
            ['Arnel Villanueva', 'Son', '09551234607', 'Pending'],
            ['Gloria Bautista', 'Daughter', '09651234608', 'Rejected'],
            ['Danilo Castillo', 'Nephew', '09751234609', 'Approved'],
            ['Rosalinda Aquino', 'Sister', '09951234610', 'Cancelled'],
            ['Federico Navarro', 'Father', '09171234611', 'Disbursed'],
            ['Imelda Fernandez', 'Mother', '09061234612', 'Pending'],
            ['Benjie Lopez', 'Son', '09151234613', 'Pending'],
            ['Salvacion Torres', 'Spouse', '09261234614', 'Approved'],
            ['Rolando Gonzales', 'Brother', '09351234615', 'Rejected'],
            ['Analyn Pascual', 'Daughter', '09451234616', 'Cancelled'],
            ['Virgilio Flores', 'Son', '09551234617', 'Disbursed'],
            ['Nenita Manalo', 'Spouse', '09651234618', 'Pending'],
            ['Jovito Domingo', 'Brother', '09751234619', 'Rejected'],
            ['Concepcion Salazar', 'Daughter', '09951234620', 'Approved'],
            ['Marlon Santos', 'Grandson', '09171234621', 'Pending'],
            ['Erlinda Reyes', 'Sister', '09061234622', 'Cancelled'],
            ['Alfredo Garcia', 'Son', '09151234623', 'Disbursed'],
            ['Luzviminda Ramos', 'Niece', '09261234624', 'Rejected'],
            ['Ernesto Mendoza', 'Brother', '09351234625', 'Pending'],
            ['Corazon Villanueva', 'Spouse', '09451234626', 'Approved'],
            ['Rommel Bautista', 'Son', '09551234627', 'Pending'],
            ['Flordeliza Castillo', 'Daughter', '09651234628', 'Cancelled'],
            ['Wilfredo Aquino', 'Brother', '09751234629', 'Rejected'],
            ['Milagros Navarro', 'Sister', '09951234630', 'Pending'],
        ];

        // Works whether the column is created_at or has been renamed to date_requested on the model.
        $requestedAtColumn = (new Claim())->getCreatedAtColumn();

        DB::transaction(function () use ($claims, $deathRecords, $requestedAtColumn) {
            $count = $deathRecords->count();
            $paidOutDeathRecords = [];

            foreach ($claims as $index => [$name, $relationship, $phone, $status]) {
                $deathRecord = $deathRecords[$index % $count];

                // A death record can only have one approved or disbursed claim; later ones are rejected.
                if (in_array($status, ['Approved', 'Disbursed'], true)) {
                    if (isset($paidOutDeathRecords[$deathRecord->id])) {
                        $status = 'Rejected';
                    } else {
                        $paidOutDeathRecords[$deathRecord->id] = true;
                    }
                }

                // The claim is always requested after the date of death and never in the future.
                $dateRequested = Carbon::parse($deathRecord->date_of_death)
                    ->addDays(7 + intdiv($index, $count) * 9 + ($index % 5))
                    ->setTime(10, 0)
                    ->min(now());

                $isApproved = in_array($status, ['Approved', 'Disbursed'], true);

                Claim::unguarded(function () use (
                    $index,
                    $deathRecord,
                    $name,
                    $relationship,
                    $phone,
                    $status,
                    $isApproved,
                    $dateRequested,
                    $requestedAtColumn
                ) {
                    Claim::updateOrCreate(
                        ['claim_ref_no' => sprintf('CLM-%s-%05d', $dateRequested->format('Y'), $index + 1)],
                        [
                            'death_record_id' => $deathRecord->id,
                            'claimant_name' => $name,
                            'claimant_relationship' => $relationship,
                            'claimant_phone_no' => $phone,
                            'status' => $status,
                            'approved_by' => $isApproved ? 1 : null,
                            'approved_at' => $isApproved ? $dateRequested->copy()->addDays(2)->min(now()) : null,
                            'requested_by' => 1,
                            $requestedAtColumn => $dateRequested,
                            'updated_at' => $dateRequested,
                        ],
                    );
                });
            }
        });
    }
}
