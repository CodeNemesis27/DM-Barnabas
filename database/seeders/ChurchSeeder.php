<?php

namespace Database\Seeders;

use App\Models\Church;
use Illuminate\Database\Seeder;

class ChurchSeeder extends Seeder
{
    public function run(): void
    {
        $churches = [
            [
                'church_code' => 'TKAPAT3501',
                'church_name' => 'Kapatagan',
                'type'        => 'Church',
            ],
            [
                'church_code' => 'TCABAD2401',
                'church_name' => 'Cabadiangan',
                'type'        => 'Church',
            ],
            [
                'church_code' => 'TANONA0601',
                'church_name' => 'Anonang',
                'type'        => 'Church',
            ],
            [
                'church_code' => 'TMALAL1101',
                'church_name' => 'Malalag',
                'type'        => 'Church',
            ],
            [
                'church_code' => 'TSANTA3701',
                'church_name' => 'Lower Santa Maria',
                'type'        => 'Church',
            ],
            [
                'church_code' => 'TTORIL3101',
                'church_name' => 'Toril Central',
                'type'        => 'Church',
            ],
            [
                'church_code' => 'TCALAC3201',
                'church_name' => 'Calachuchi',
                'type'        => 'Company',
            ],
        ];

        foreach ($churches as $data) {
            Church::updateOrCreate(
                ['church_code' => $data['church_code']],
                [
                    'church_name' => $data['church_name'],
                    'type'        => $data['type'],
                ]
            );
        }
    }
}
