<?php

namespace Database\Seeders;

use App\Models\Church;
use Illuminate\Database\Seeder;

class ChurchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $churches = [
            [
                'church_name' => 'Adams Center',
                'church_code' => 'TADAMS2701',
                'type' => 'Church',
                'locality_id' => 4,
                'district_id' => 1,
                'church_members' => '2394',
            ],

            // --------------------- Apo View Kapatagan --------------------- //
            [
                'church_name' => 'Kapatagan',
                'church_code' => 'TKAPAT3501',
                'type' => 'Church',
                'locality_id' => 5,
                'district_id' => 2,
                'church_members' => '316',
            ],
            [
                'church_name' => 'Palo Cinco',
                'church_code' => 'TPALOC0501',
                'type' => 'Company',
                'locality_id' => 5,
                'district_id' => 2,
                'church_members' => '316',
            ],

            // --------------------- Babak District --------------------- //
            [
                'church_name' => 'Tagpopongan',
                'church_code' => 'TTAGPO2401',
                'type' => 'Church',
                'locality_id' => 8,
                'district_id' => 3,
                'church_members' => '82',
            ],
            [
                'church_name' => 'San Antonio (Babak)',
                'church_code' => 'TSANAN2401',
                'type' => 'Company',
                'locality_id' => 8,
                'district_id' => 3,
                'church_members' => '84',
            ],

            // --------------------- Bansalan District --------------------- //

            [
                'church_name' => 'Malupo',
                'church_code' => 'TMALUP1001',
                'type' => 'Company',
                'locality_id' => 2,
                'district_id' => 5,
                'church_members' => '92',
            ],

            // --------------------- Buhangin District --------------------- //

            [
                'church_name' => 'Veterans Village',
                'church_code' => 'TTRANS3401',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 6,
                'church_members' => '84',
            ],

            // --------------------- Caburan District --------------------- //
            [
                'church_name' => 'Tanuman',
                'church_code' => 'TTANUM1201',
                'type' => 'Company',
                'locality_id' => 9,
                'district_id' => 8,
                'church_members' => '192',
            ],

            // --------------------- Calinan District --------------------- //

            [
                'church_name' => 'Sicao',
                'church_code' => 'TSICAO0201',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 10,
                'church_members' => '154',
            ],
            [
                'church_name' => 'Wines',
                'church_code' => 'TWINES0201',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 10,
                'church_members' => '158',
            ],

            // --------------------- Digos District --------------------- //

            [
                'church_name' => 'Ruparan',
                'church_code' => 'TRUPAR0501',
                'type' => 'Church',
                'locality_id' => 5,
                'district_id' => 14,
                'church_members' => '99',
            ],
            [
                'church_name' => 'Tiguman',
                'church_code' => 'TTIGUM0501',
                'type' => 'Church',
                'locality_id' => 5,
                'district_id' => 14,
                'church_members' => '121',
            ],

            [
                'church_name' => 'Mahayahay',
                'church_code' => 'TMAHAY0501',
                'type' => 'Company',
                'locality_id' => 5,
                'district_id' => 14,
                'church_members' => '14',
            ],
            [
                'church_name' => 'Small Group',
                'church_code' => 'TSDASM0501',
                'type' => 'Company',
                'locality_id' => 5,
                'district_id' => 14,
                'church_members' => '102',
            ],

            // --------------------- Don Marcelino District --------------------- //

            [
                'church_name' => 'Lanipao',
                'church_code' => 'TLANIP1201',
                'type' => 'Company',
                'locality_id' => 6,
                'district_id' => 15,
                'church_members' => '148',
            ],
            [
                'church_name' => 'Vetarba/Talagutong',
                'church_code' => 'TTALAG1202',
                'type' => 'Company',
                'locality_id' => 6,
                'district_id' => 15,
                'church_members' => '184',
            ],

            // --------------------- Filipino-Chinese Church --------------------- //
            [
                'church_name' => 'Filipino-Chinese',
                'church_code' => 'TFILIP2701',
                'type' => 'Church',
                'locality_id' => 4,
                'district_id' => 16,
                'church_members' => '179',
            ],

            // --------------------- Hagonoy District --------------------- //
            [
                'church_name' => 'Campo 10',
                'church_code' => 'TCAMPO2101',
                'type' => 'Church',
                'locality_id' => 5,
                'district_id' => 17,
                'church_members' => '1109',
            ],


            // --------------------- Kaputian District --------------------- //
            [
                'church_name' => 'Anonang',
                'church_code' => 'TANONA0601',
                'type' => 'Church',
                'locality_id' => 8,
                'district_id' => 18,
                'church_members' => '237',
            ],


            // --------------------- Little Baguio District --------------------- //

            [
                'church_name' => 'Talabong',
                'church_code' => 'TTALAB1201',
                'type' => 'Company',
                'locality_id' => 14,
                'district_id' => 19,
                'church_members' => '83',
            ],

            // --------------------- Magsaysay District --------------------- //

            [
                'church_name' => 'New Opon',
                'church_code' => 'TNEWOP1001',
                'type' => 'Church',
                'locality_id' => 12,
                'district_id' => 20,
            ],
            [
                'church_name' => 'Hillside',
                'church_code' => 'THILLS1001',
                'type' => 'Company',
                'locality_id' => 12,
                'district_id' => 20,
                'church_members' => '82',
            ],


            // --------------------- Malabog District --------------------- //

            [
                'church_name' => 'Panulawan',
                'church_code' => 'TPANUL2301',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 21,
                'church_members' => '80',
            ],
            [
                'church_name' => 'Polokon',
                'church_code' => 'TPOLOC0201',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 21,
                'church_members' => '65',
            ],
            [
                'church_name' => 'Saloy',
                'church_code' => 'TSALOY0201',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 21,
                'church_members' => '53',
            ],


            // --------------------- Malalag District --------------------- //

            [
                'church_name' => 'Lower Baclayon',
                'church_code' => 'TLOWEB1101',
                'type' => 'Church',
                'locality_id' => 13,
                'district_id' => 22,
                'church_members' => '97',
            ],


            // --------------------- Malita Church --------------------- //
            [
                'church_name' => 'Malita Center',
                'church_code' => 'TMALIT1201',
                'type' => 'Church',
                'locality_id' => 14,
                'district_id' => 23,
                'church_members' => '1590',
            ],

            // --------------------- Malita District --------------------- //

            [
                'church_name' => 'Tubalan Beach',
                'church_code' => 'TTUBAL1201',
                'type' => 'Church',
                'locality_id' => 14,
                'district_id' => 24,
                'church_members' => '50',
            ],



            // --------------------- Marilog A District --------------------- //

            [
                'church_name' => 'Lanao Koran',
                'church_code' => 'TLANAO1401',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 25,
                'church_members' => '0',
            ],
            [
                'church_name' => 'Katipunan',
                'church_code' => 'TKATIP1401',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 25,
                'church_members' => '0',
            ],
            [
                'church_name' => 'Bala',
                'church_code' => 'TBALAC1401',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 25,
                'church_members' => '0',
            ],
            // --------------------- Marilog B District --------------------- //

            [
                'church_name' => 'Upian',
                'church_code' => 'TUPIAN1401',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 26,
                'church_members' => '25',
            ],

            // --------------------- Matan-ao District --------------------- //

            [
                'church_name' => 'Managa',
                'church_code' => 'TMANAG1501',
                'type' => 'Church',
                'locality_id' => 16,
                'district_id' => 27,
                'church_members' => '301',
            ],
            [
                'church_name' => 'Matan-ao',
                'church_code' => 'TMATAN1501',
                'type' => 'Church',
                'locality_id' => 16,
                'district_id' => 27,
                'church_members' => '290',
            ],
            [
                'church_name' => 'New Katipunan (Matan-ao)',
                'church_code' => 'TNEWKA1501',
                'type' => 'Church',
                'locality_id' => 16,
                'district_id' => 27,
                'church_members' => '132',
            ],
            [
                'church_name' => 'Tibongbong',
                'church_code' => 'TTIBON1501',
                'type' => 'Church',
                'locality_id' => 16,
                'district_id' => 27,
                'church_members' => '108',
            ],

            // --------------------- Padada District --------------------- //

            [
                'church_name' => 'Harada Butai',
                'church_code' => 'THAROD2101',
                'type' => 'Company',
                'locality_id' => 17,
                'district_id' => 28,
                'church_members' => '187',
            ],

            // --------------------- Santa Maria District --------------------- //

            [
                'church_name' => 'Lais',
                'church_code' => 'TLAISC1101',
                'type' => 'Company',
                'locality_id' => 19,
                'district_id' => 33,
                'church_members' => '150',
            ],


            // --------------------- Toril Central --------------------- //
            [
                'church_name' => 'Toril Central',
                'church_code' => 'TTORIL3101',
                'type' => 'Church',
                'locality_id' => 4,
                'district_id' => 38,
                'church_members' => '1286',
            ],

            // --------------------- Toril District --------------------- //

            [
                'church_name' => 'Tagurano',
                'church_code' => 'TTAGUR3101',
                'type' => 'Church',
                'locality_id' => 4,
                'district_id' => 39,
                'church_members' => '170',
            ],
            [
                'church_name' => 'Baracayo',
                'church_code' => 'TBARAK3101',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 39,
                'church_members' => '122',
            ],

            [
                'church_name' => 'Inawayan',
                'church_code' => 'TINAWA3101',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 39,
                'church_members' => '137',
            ],

            // --------------------- Tugbok District --------------------- //
            [
                'church_name' => '117 Bago Oshiro',
                'church_code' => 'TBAGOO3201',
                'type' => 'Church',
                'locality_id' => 4,
                'district_id' => 40,
                'church_members' => '152',
            ],
            [
                'church_name' => 'Bamboo Tacunan',
                'church_code' => 'TTACUN3201',
                'type' => 'Church',
                'locality_id' => 4,
                'district_id' => 40,
                'church_members' => '281',
            ],
            [
                'church_name' => 'Calachuchi',
                'church_code' => 'TCALAC3201',
                'type' => 'Church',
                'locality_id' => 4,
                'district_id' => 40,
                'church_members' => '250',
            ],
            [
                'church_name' => 'Catalunan Grande',
                'church_code' => 'TCATAL3201',
                'type' => 'Church',
                'locality_id' => 4,
                'district_id' => 40,
                'church_members' => '516',
            ],
            [
                'church_name' => 'Garcia Memorial',
                'church_code' => 'TGARCI3201',
                'type' => 'Church',
                'locality_id' => 4,
                'district_id' => 40,
                'church_members' => '205',
            ],
            [
                'church_name' => 'Los Amigos',
                'church_code' => 'TLOSAM3201',
                'type' => 'Church',
                'locality_id' => 4,
                'district_id' => 40,
                'church_members' => '253',
            ],
            [
                'church_name' => 'Smallville',
                'church_code' => 'TSMALL3201',
                'type' => 'Church',
                'locality_id' => 4,
                'district_id' => 40,
                'church_members' => '157',
            ],
            [
                'church_name' => 'Upper Mintal',
                'church_code' => 'TMINTA3201',
                'type' => 'Church',
                'locality_id' => 4,
                'district_id' => 40,
                'church_members' => '50',
            ],
            [
                'church_name' => 'Biao Escuela',
                'church_code' => 'TBIAOE3201',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 40,
                'church_members' => '50',
            ],
            [
                'church_name' => 'Biao Tienda',
                'church_code' => 'TBIAOT3201',
                'type' => 'Company',
                'locality_id' => 4,
                'district_id' => 40,
                'church_members' => '97',
            ],
        ];

        foreach ($churches as $data) {
            Church::updateOrCreate(
                ['church_code' => $data['church_code']],
                $data
            );
        }
    }
}
