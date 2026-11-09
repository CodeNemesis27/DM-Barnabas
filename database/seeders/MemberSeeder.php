<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $churchIds = DB::table('churches')->pluck('id')->all();

        if (empty($churchIds)) {
            $this->command?->error('No churches found. Seed the churches table first.');

            return;
        }

        $password = Hash::make('password');

        // first, middle, last, suffix, gender, birth date, civil status, occupation, address, phone, class, status
        $members = [
            ['Juan', 'Santos', 'Dela Cruz', null, 'Male', '1985-03-12', 'Married', 'Farmer', '123 Rizal St., Brgy. Poblacion, Tacurong City, Sultan Kudarat', '09171234501', 'A', 'Active'],
            ['Maria', 'Reyes', 'Garcia', null, 'Female', '1990-07-21', 'Married', 'Teacher', '45 Mabini St., Brgy. San Isidro, Koronadal City, South Cotabato', '09061234502', 'A', 'Active'],
            ['Jose', 'Ramos', 'Mendoza', 'Jr.', 'Male', '1978-11-05', 'Married', 'Tricycle Driver', '78 Bonifacio St., Brgy. Santo Niño, General Santos City, South Cotabato', '09151234503', 'B', 'Active'],
            ['Ana', 'Bautista', 'Villanueva', null, 'Female', '1995-01-30', 'Single', 'Nurse', '210 Luna St., Brgy. San Jose, Kidapawan City, Cotabato', '09261234504', 'A', 'Active'],
            ['Ramon', 'Aquino', 'Castillo', 'Sr.', 'Male', '1952-09-14', 'Widowed', 'Fisherman', '12 Quezon Ave., Brgy. Bagong Silang, Davao City, Davao del Sur', '09351234505', 'B', 'Deceased'],
            ['Rosario', 'Navarro', 'Fernandez', null, 'Female', '1960-04-18', 'Widowed', 'Sari-sari Store Owner', '66 Magsaysay St., Brgy. Mabuhay, Cagayan de Oro City, Misamis Oriental', '09451234506', 'B', 'Active'],
            ['Mark', 'Torres', 'Lopez', null, 'Male', '1998-12-02', 'Single', 'Call Center Agent', '9 Del Pilar St., Brgy. San Roque, Quezon City, Metro Manila', '09551234507', 'A', 'Active'],
            ['Lourdes', 'Gonzales', 'Pascual', null, 'Female', '1983-06-25', 'Married', 'Government Employee', '301 Osmeña St., Brgy. Sta. Cruz, Cebu City, Cebu', '09651234508', 'A', 'Active'],
            ['Eduardo', 'Flores', 'Manalo', 'II', 'Male', '1970-02-09', 'Married', 'Electrician', '88 Roxas Ave., Brgy. Maligaya, Iloilo City, Iloilo', '09751234509', 'B', 'Active'],
            ['Josephine', 'Domingo', 'Salazar', null, 'Female', '1988-10-16', 'Separated', 'Seamstress', '17 Aguinaldo St., Brgy. Pag-asa, Cabanatuan City, Nueva Ecija', '09951234510', 'B', 'Active'],
            ['John Paul', 'Dela Cruz', 'Santos', null, 'Male', '2001-05-27', 'Single', 'Student', '54 Rizal St., Brgy. San Isidro, Tacurong City, Sultan Kudarat', '09171234511', 'A', 'Active'],
            ['Cristina', 'Garcia', 'Reyes', null, 'Female', '1975-08-08', 'Married', 'Accountant', '132 Mabini St., Brgy. Poblacion, Koronadal City, South Cotabato', '09061234512', 'A', 'Active'],
            ['Antonio', 'Mendoza', 'Ramos', 'III', 'Male', '1965-01-19', 'Married', 'Carpenter', '27 Bonifacio St., Brgy. San Jose, General Santos City, South Cotabato', '09151234513', 'B', 'Active'],
            ['Elizabeth', 'Villanueva', 'Bautista', null, 'Female', '1992-03-03', 'Single', 'Barangay Health Worker', '95 Luna St., Brgy. Santo Niño, Kidapawan City, Cotabato', '09261234514', 'A', 'Active'],
            ['Ricardo', 'Castillo', 'Aquino', null, 'Male', '1958-12-24', 'Widowed', 'Farmer', '3 Quezon Ave., Brgy. Mabuhay, Davao City, Davao del Sur', '09351234515', 'B', 'Deceased'],
            ['Mary Grace', 'Fernandez', 'Navarro', null, 'Female', '1999-09-11', 'Single', 'Student', '140 Magsaysay St., Brgy. Bagong Silang, Cagayan de Oro City, Misamis Oriental', '09451234516', 'A', 'Active'],
            ['Reynaldo', 'Lopez', 'Torres', null, 'Male', '1980-07-07', 'Married', 'Mechanic', '61 Del Pilar St., Brgy. Pag-asa, Quezon City, Metro Manila', '09551234517', 'B', 'Active'],
            ['Angelica', 'Pascual', 'Gonzales', null, 'Female', '1994-02-14', 'Single', 'Nurse', '222 Osmeña St., Brgy. Poblacion, Cebu City, Cebu', '09651234518', 'A', 'Active'],
            ['Rodrigo', 'Manalo', 'Flores', 'Jr.', 'Male', '1987-11-30', 'Married', 'Security Guard', '18 Roxas Ave., Brgy. San Roque, Iloilo City, Iloilo', '09751234519', 'B', 'Active'],
            ['Jennifer', 'Salazar', 'Domingo', null, 'Female', '1984-05-22', 'Separated', 'Vendor', '76 Aguinaldo St., Brgy. Maligaya, Cabanatuan City, Nueva Ecija', '09951234520', 'B', 'Active'],
            ['Michael', 'Santos', 'Reyes', null, 'Male', '1991-08-17', 'Single', 'Welder', '39 Rizal St., Brgy. Sta. Cruz, Tacurong City, Sultan Kudarat', '09171234521', 'A', 'Active'],
            ['Rowena', 'Reyes', 'Dela Cruz', null, 'Female', '1972-06-06', 'Married', 'Housekeeper', '104 Mabini St., Brgy. San Jose, Koronadal City, South Cotabato', '09061234522', 'B', 'Active'],
            ['Noel', 'Garcia', 'Mendoza', null, 'Male', '1968-04-01', 'Married', 'Pastor', '57 Bonifacio St., Brgy. Santo Niño, General Santos City, South Cotabato', '09151234523', 'A', 'Active'],
            ['Marites', 'Ramos', 'Villanueva', null, 'Female', '1963-10-29', 'Widowed', 'Sari-sari Store Owner', '14 Luna St., Brgy. Mabuhay, Kidapawan City, Cotabato', '09261234524', 'B', 'Deceased'],
            ['Christian', 'Bautista', 'Castillo', null, 'Male', '2000-01-15', 'Single', 'Call Center Agent', '230 Quezon Ave., Brgy. Bagong Silang, Davao City, Davao del Sur', '09351234525', 'A', 'Active'],
            ['Divina', 'Aquino', 'Fernandez', null, 'Female', '1979-12-12', 'Married', 'Teacher', '81 Magsaysay St., Brgy. Pag-asa, Cagayan de Oro City, Misamis Oriental', '09451234526', 'A', 'Active'],
            ['Jericho', 'Navarro', 'Lopez', null, 'Male', '1996-03-23', 'Single', 'Electrician', '5 Del Pilar St., Brgy. Poblacion, Quezon City, Metro Manila', '09551234527', 'B', 'Active'],
            ['Cherry', 'Torres', 'Pascual', null, 'Female', '1989-09-09', 'Separated', 'Seamstress', '167 Osmeña St., Brgy. San Isidro, Cebu City, Cebu', '09651234528', 'B', 'Active'],
            ['Joseph', 'Flores', 'Manalo', 'Sr.', 'Male', '1955-07-04', 'Widowed', 'Fisherman', '49 Roxas Ave., Brgy. Santo Niño, Iloilo City, Iloilo', '09751234529', 'B', 'Active'],
            ['Liza', 'Domingo', 'Salazar', null, 'Female', '1993-11-18', 'Married', 'Government Employee', '92 Aguinaldo St., Brgy. San Jose, Cabanatuan City, Nueva Ecija', '09951234530', 'A', 'Active'],
        ];

        DB::transaction(function () use ($members, $churchIds, $password) {
            foreach (
                $members as $index => [
                    $firstName,
                    $middleName,
                    $lastName,
                    $suffix,
                    $gender,
                    $dateOfBirth,
                    $civilStatus,
                    $occupation,
                    $address,
                    $phoneNo,
                    $class,
                    $status,
                ]
            ) {
                $email = Str::slug("{$firstName}.{$lastName}", '.') . '.' . ($index + 1) . '@example.com';

                $user = User::updateOrCreate(
                    ['email' => $email],
                    [
                        'name' => "{$firstName} {$lastName}",
                        'password' => $password,
                        'email_verified_at' => now(),
                    ],
                );

                Member::unguarded(function () use (
                    $user,
                    $firstName,
                    $middleName,
                    $lastName,
                    $suffix,
                    $gender,
                    $dateOfBirth,
                    $civilStatus,
                    $occupation,
                    $address,
                    $phoneNo,
                    $class,
                    $status,
                    $churchIds
                ) {
                    Member::withTrashed()->updateOrCreate(
                        ['user_id' => $user->id],
                        [
                            'first_name' => $firstName,
                            'middle_name' => $middleName,
                            'last_name' => $lastName,
                            'suffix' => $suffix,
                            'gender' => $gender,
                            'date_of_birth' => $dateOfBirth,
                            'civil_status' => $civilStatus,
                            'occupation' => $occupation,
                            'address' => $address,
                            'phone_no' => $phoneNo,
                            'church_id' => $churchIds[array_rand($churchIds)],
                            'class' => $class,
                            'status' => $status,
                            'created_by' => 1,
                        ],
                    );
                });
            }
        });
    }
}
