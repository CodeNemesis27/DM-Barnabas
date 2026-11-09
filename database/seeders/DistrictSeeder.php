<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            [
                'district_name' => 'Adams Center',
                'district_code' => 'DTADAMS01',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Apo View Kapatagan',
                'district_code' => 'DTAPOVA01',
                'locality_id' => 5,
            ],
            [
                'district_name' => 'Babak District',
                'district_code' => 'DTPENAP01',
                'locality_id' => 8,
            ],
            [
                'district_name' => 'Bangkal',
                'district_code' => 'DTBANGK01',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Bansalan District',
                'district_code' => 'DTBANSA01',
                'locality_id' => 2,
            ],
            [
                'district_name' => 'Buhangin District',
                'district_code' => 'DTBUHAN01',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Bunawan District',
                'district_code' => 'DTBUNAW01',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Caburan District',
                'district_code' => 'DTCABUR02',
                'locality_id' => 9,
            ],
            [
                'district_name' => 'Calinan Central Church',
                'district_code' => 'DTCALIN01',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Calinan District',
                'district_code' => 'DTCALIN02',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Davao City Central Church',
                'district_code' => 'DTDAVCE01',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Digos Center Church',
                'district_code' => 'DTDIGCE01',
                'locality_id' => 5,
            ],
            [
                'district_name' => 'Digos Central Church',
                'district_code' => 'DTDIGCE03',
                'locality_id' => 5,
            ],
            [
                'district_name' => 'Digos District',
                'district_code' => 'DTDIGOS01',
                'locality_id' => 5,
            ],
            [
                'district_name' => 'Don Marcelino',
                'district_code' => 'DTDONMA01',
                'locality_id' => 6,
            ],
            [
                'district_name' => 'Filipino-Chinese Church',
                'district_code' => 'DTFILCH01',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Hagonoy District',
                'district_code' => 'DTHAGON01',
                'locality_id' => 5,
            ],
            [
                'district_name' => 'Kaputian District',
                'district_code' => 'DTKAPUT01',
                'locality_id' => 8,
            ],
            [
                'district_name' => 'Little Baguio District',
                'district_code' => 'DTLITTL01',
                'locality_id' => 14,
            ],
            [
                'district_name' => 'Magsaysay District',
                'district_code' => 'DTMAGSA01',
                'locality_id' => 12,
            ],
            [
                'district_name' => 'Malabog District',
                'district_code' => 'DTMALAB01',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Malalag District',
                'district_code' => 'DTMALAL01',
                'locality_id' => 13,
            ],
            [
                'district_name' => 'Malita Church',
                'district_code' => 'DTMALIT01',
                'locality_id' => 14,
            ],
            [
                'district_name' => 'Malita District',
                'district_code' => 'DTMALIT02',
                'locality_id' => 14,
            ],
            [
                'district_name' => 'Marilog A District',
                'district_code' => 'DTMARIL01',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Marilog B District',
                'district_code' => 'DTMARIL02',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Matan-ao District',
                'district_code' => 'DTMATAN01',
                'locality_id' => 16,
            ],
            [
                'district_name' => 'Padada District',
                'district_code' => 'DTPADAD01',
                'locality_id' => 17,
            ],
            [
                'district_name' => 'Peñaplata District',
                'district_code' => 'DTPENAB01',
                'locality_id' => 8,
            ],
            [
                'district_name' => 'San Jose Church',
                'district_code' => 'DTSANJO01',
                'locality_id' => 5,
            ],
            [
                'district_name' => 'SPAC',
                'district_code' => 'DTSPACD01',
                'locality_id' => 16,
            ],
            [
                'district_name' => 'Santa Cruz District',
                'district_code' => 'DTSANTA01',
                'locality_id' => 18,
            ],
            [
                'district_name' => 'Santa Maria District',
                'district_code' => 'DTSANTA02',
                'locality_id' => 19,
            ],
            [
                'district_name' => 'Sulop District',
                'district_code' => 'DTSULOP01',
                'locality_id' => 20,
            ],
            [
                'district_name' => 'Talicud Island District',
                'district_code' => 'DTTALIC01',
                'locality_id' => 8,
            ],
            [
                'district_name' => 'Talus District',
                'district_code' => 'DTTALUS01',
                'locality_id' => 17,
            ],
            [
                'district_name' => 'Tamugan District',
                'district_code' => 'DTTAMUG01',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Toril Central',
                'district_code' => 'DTTORIL02',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Toril District',
                'district_code' => 'DTTORIL01',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Tugbok District',
                'district_code' => 'DTTUGBO02',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Tugbok Attached Field',
                'district_code' => 'DTTUGBO01',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Urban',
                'district_code' => 'DTURBAN01',
                'locality_id' => 4,
            ],
            [
                'district_name' => 'Upper Room Fellowship',
                'district_code' => 'DTUPROO01',
                'locality_id' => 4,
            ],
        ];

        foreach ($districts as $data) {
            District::updateOrCreate(
                ['district_code' => $data['district_code']],
                [
                    'district_name' => $data['district_name'],
                    'locality_id'   => $data['locality_id'],
                ]
            );
        }
    }
}
