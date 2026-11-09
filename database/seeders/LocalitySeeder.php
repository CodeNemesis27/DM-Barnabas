<?php

namespace Database\Seeders;

use App\Models\Locality;
use Illuminate\Database\Seeder;

class LocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $localities = [
            ['locality_name' => 'Arakan, North Cotabato'],
            ['locality_name' => 'Bansalan, Davao del Sur'],
            ['locality_name' => 'Columbio, Sultan Kudarat'],
            ['locality_name' => 'Davao City, Davao del Sur'],
            ['locality_name' => 'Digos City, Davao del Sur'],
            ['locality_name' => 'Don Marcelino, Davao Occidental'],
            ['locality_name' => 'Hagonoy, Davao del Sur'],
            ['locality_name' => 'Island Garden City of Samal, Davao del Norte'],
            ['locality_name' => 'Jose Abad Santos, Davao Occidental'],
            ['locality_name' => 'Kiblawan, Davao del Sur'],
            ['locality_name' => 'Kitaotao, Bukidnon'],
            ['locality_name' => 'Magsaysay, Davao del Sur'],
            ['locality_name' => 'Malalag, Davao del Sur'],
            ['locality_name' => 'Malita, Davao Occidental'],
            ['locality_name' => 'Malungon, Sarangani'],
            ['locality_name' => 'Matan-ao, Davao del Sur'],
            ['locality_name' => 'Padada, Davao del Sur'],
            ['locality_name' => 'Santa Cruz, Davao del Sur'],
            ['locality_name' => 'Santa Maria, Davao Occidental'],
            ['locality_name' => 'Sulop, Davao del Sur'],
        ];

        foreach ($localities as $data) {
            Locality::updateOrCreate(
                ['locality_name' => $data['locality_name']],
                [
                    'locality_name' => $data['locality_name'],
                ]
            );
        }
    }
}
