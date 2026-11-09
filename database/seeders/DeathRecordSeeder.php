<?php

namespace Database\Seeders;

use App\Models\DeathRecord;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeathRecordSeeder extends Seeder
{
    public function run(): void
    {
        $members = Member::query()
            ->where('status', 'Deceased')
            ->orderBy('id')
            ->get();

        if ($members->isEmpty()) {
            $this->command?->warn('No members with Deceased status found. Run MemberSeeder first.');

            return;
        }

        // date of death, place of death, cause type, cause of death
        $scenarios = [
            ['2025-03-14', 'Davao Regional Medical Center, Tagum City, Davao del Norte', 'Illness or disease', 'Acute myocardial infarction (heart attack)'],
            ['2025-06-02', 'Residence, Brgy. Poblacion, Tacurong City, Sultan Kudarat', 'Illness or disease', 'Pneumonia with respiratory failure'],
            ['2025-08-21', 'Provincial Road, Brgy. San Jose, Koronadal City, South Cotabato', 'Accidental', 'Multiple injuries from a motorcycle collision'],
            ['2025-10-09', 'Sultan Kudarat Provincial Hospital, Isulan, Sultan Kudarat', 'Illness or disease', 'Chronic kidney disease, end-stage'],
            ['2025-12-27', 'Evacuation Center, Brgy. Mabuhay, Kidapawan City, Cotabato', 'Disaster-related', 'Injuries sustained during a flash flood'],
            ['2026-02-11', 'Residence, Brgy. Santo Niño, General Santos City, South Cotabato', 'Undetermined', 'Found unresponsive at home; cause pending medical certification'],
            ['2026-04-30', 'Cotabato Regional and Medical Center, Cotabato City', 'Illness or disease', 'Stroke (cerebrovascular accident)'],
            ['2026-07-18', 'Brgy. Bagong Silang, Davao City, Davao del Sur', 'Accidental', 'Drowning'],
        ];

        DB::transaction(function () use ($members, $scenarios) {
            foreach ($members as $index => $member) {
                [$deathDate, $place, $type, $cause] = $scenarios[$index % count($scenarios)];

                // The date of death can never be earlier than the member's birth date.
                $dateOfDeath = Carbon::parse($deathDate)->max(Carbon::parse($member->date_of_birth));

                $refNo = sprintf('DR-%s-%05d', $dateOfDeath->format('Y'), $member->id);

                DeathRecord::unguarded(function () use ($member, $refNo, $dateOfDeath, $place, $type, $cause) {
                    DeathRecord::withTrashed()->updateOrCreate(
                        ['member_id' => $member->id],
                        [
                            'death_record_ref_no' => $refNo,
                            'date_of_death' => $dateOfDeath->toDateString(),
                            'place_of_death' => $place,
                            'death_cause_type' => $type,
                            'cause_of_death' => $cause,
                            'created_by' => 1,
                        ],
                    );
                });
            }
        });
    }
}
