<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Church;
use Illuminate\Database\Seeder;
use RuntimeException;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $churches = Church::pluck('id', 'church_code');

        $members = [
            // Kapatagan (TKAPAT3501)
            ['Juan', 'Santos', 'Dela Cruz', '1985-04-12', '0900-000-0001', 'Poblacion, Kapatagan', 'TKAPAT3501'],
            ['Maria', 'Garcia', 'Reyes', '1990-08-23', '0900-000-0002', 'Centro, Kapatagan', 'TKAPAT3501'],
            ['Pedro', 'Lopez', 'Santos', '1978-02-15', '0900-000-0003', 'San Isidro, Kapatagan', 'TKAPAT3501'],
            ['Ana', 'Cruz', 'Mendoza', '1995-11-30', '0900-000-0004', 'Poblacion, Kapatagan', 'TKAPAT3501'],
            ['Jose', 'Ramos', 'Garcia', '1982-06-19', '0900-000-0005', 'New Visayas, Kapatagan', 'TKAPAT3501'],
            ['Elena', 'Torres', 'Fernandez', '1988-09-07', '0900-000-0006', 'San Vicente, Kapatagan', 'TKAPAT3501'],
            ['Carlos', 'Bautista', 'Rivera', '1975-12-03', '0900-000-0007', 'Poblacion, Kapatagan', 'TKAPAT3501'],
            ['Rosa', 'Villanueva', 'Castillo', '1992-03-25', '0900-000-0008', 'San Isidro, Kapatagan', 'TKAPAT3501'],
            ['Miguel', 'Aquino', 'Perez', '1980-07-14', '0900-000-0009', 'New Visayas, Kapatagan', 'TKAPAT3501'],
            ['Teresa', 'Morales', 'Gonzales', '1998-01-09', '0900-000-0010', 'Poblacion, Kapatagan', 'TKAPAT3501'],

            // Cabadiangan (TCABAD2401)
            ['Andres', 'Flores', 'Navarro', '1986-05-18', '0900-000-0011', 'Cabadiangan, Davao del Sur', 'TCABAD2401'],
            ['Carmen', 'Diaz', 'Salazar', '1991-10-22', '0900-000-0012', 'Cabadiangan, Davao del Sur', 'TCABAD2401'],
            ['Roberto', 'Mendoza', 'Castro', '1979-04-05', '0900-000-0013', 'Cabadiangan, Davao del Sur', 'TCABAD2401'],
            ['Lucia', 'Ramos', 'Ortega', '1987-12-11', '0900-000-0014', 'Cabadiangan, Davao del Sur', 'TCABAD2401'],
            ['Fernando', 'Reyes', 'Aguilar', '1983-08-29', '0900-000-0015', 'Cabadiangan, Davao del Sur', 'TCABAD2401'],
            ['Patricia', 'Santos', 'Valdez', '1994-02-17', '0900-000-0016', 'Cabadiangan, Davao del Sur', 'TCABAD2401'],
            ['Eduardo', 'Garcia', 'Domingo', '1976-06-24', '0900-000-0017', 'Cabadiangan, Davao del Sur', 'TCABAD2401'],
            ['Sofia', 'Fernandez', 'Manalo', '1996-09-13', '0900-000-0018', 'Cabadiangan, Davao del Sur', 'TCABAD2401'],
            ['Antonio', 'Rivera', 'Salvador', '1981-11-08', '0900-000-0019', 'Cabadiangan, Davao del Sur', 'TCABAD2401'],

            // Anonang (TANONA0601)
            ['Isabel', 'Castillo', 'Aquino', '1989-03-16', '0900-000-0020', 'Anonang, Davao del Sur', 'TANONA0601'],
            ['Daniel', 'Perez', 'Villanueva', '1984-07-21', '0900-000-0021', 'Anonang, Davao del Sur', 'TANONA0601'],
            ['Gabriela', 'Gonzales', 'Torres', '1993-05-14', '0900-000-0022', 'Anonang, Davao del Sur', 'TANONA0601'],
            ['Manuel', 'Navarro', 'Flores', '1977-09-26', '0900-000-0023', 'Anonang, Davao del Sur', 'TANONA0601'],
            ['Beatriz', 'Salazar', 'Morales', '1997-12-02', '0900-000-0024', 'Anonang, Davao del Sur', 'TANONA0601'],
            ['Ricardo', 'Castro', 'Bautista', '1982-01-19', '0900-000-0025', 'Anonang, Davao del Sur', 'TANONA0601'],
            ['Angela', 'Ortega', 'Dela Cruz', '1990-06-08', '0900-000-0026', 'Anonang, Davao del Sur', 'TANONA0601'],
            ['Francisco', 'Aguilar', 'Reyes', '1974-10-31', '0900-000-0027', 'Anonang, Davao del Sur', 'TANONA0601'],
            ['Monica', 'Valdez', 'Santos', '1988-04-27', '0900-000-0028', 'Anonang, Davao del Sur', 'TANONA0601'],

            // Malalag (TMALAL1101)
            ['Ramon', 'Domingo', 'Garcia', '1985-08-16', '0900-000-0029', 'Poblacion, Malalag', 'TMALAL1101'],
            ['Cristina', 'Manalo', 'Rivera', '1999-02-11', '0900-000-0030', 'Poblacion, Malalag', 'TMALAL1101'],
            ['Alberto', 'Salvador', 'Ramos', '1979-03-20', '0900-000-0031', 'Poblacion, Malalag', 'TMALAL1101'],
            ['Maribel', 'Perez', 'Lopez', '1986-11-05', '0900-000-0032', 'Malalag, Davao del Sur', 'TMALAL1101'],
            ['Julio', 'Fernandez', 'Cruz', '1992-07-12', '0900-000-0033', 'Malalag, Davao del Sur', 'TMALAL1101'],
            ['Lourdes', 'Aquino', 'Mendoza', '1981-09-24', '0900-000-0034', 'Poblacion, Malalag', 'TMALAL1101'],
            ['Oscar', 'Villanueva', 'Diaz', '1976-12-18', '0900-000-0035', 'Malalag, Davao del Sur', 'TMALAL1101'],
            ['Janet', 'Morales', 'Flores', '1995-04-09', '0900-000-0036', 'Malalag, Davao del Sur', 'TMALAL1101'],
            ['Renato', 'Torres', 'Navarro', '1983-06-28', '0900-000-0037', 'Poblacion, Malalag', 'TMALAL1101'],

            // Lower Santa Maria (TSANTA3701)
            ['Gloria', 'Bautista', 'Castillo', '1991-01-15', '0900-000-0038', 'Lower Santa Maria, Davao del Sur', 'TSANTA3701'],
            ['Emilio', 'Reyes', 'Garcia', '1987-10-03', '0900-000-0039', 'Lower Santa Maria, Davao del Sur', 'TSANTA3701'],
            ['Nina', 'Santos', 'Rivera', '1998-08-20', '0900-000-0040', 'Lower Santa Maria, Davao del Sur', 'TSANTA3701'],
            ['Victor', 'Mendoza', 'Perez', '1980-02-07', '0900-000-0041', 'Lower Santa Maria, Davao del Sur', 'TSANTA3701'],
            ['Rosario', 'Garcia', 'Torres', '1989-05-25', '0900-000-0042', 'Lower Santa Maria, Davao del Sur', 'TSANTA3701'],
            ['Benjamin', 'Dela Cruz', 'Aquino', '1975-07-17', '0900-000-0043', 'Lower Santa Maria, Davao del Sur', 'TSANTA3701'],
            ['Estrella', 'Lopez', 'Castillo', '1994-11-12', '0900-000-0044', 'Lower Santa Maria, Davao del Sur', 'TSANTA3701'],
            ['Gerald', 'Ramos', 'Villanueva', '1984-03-30', '0900-000-0045', 'Lower Santa Maria, Davao del Sur', 'TSANTA3701'],
            ['Melinda', 'Flores', 'Salazar', '1993-09-06', '0900-000-0046', 'Lower Santa Maria, Davao del Sur', 'TSANTA3701'],

            // Toril Central (TTORIL3101)
            ['Dennis', 'Navarro', 'Morales', '1978-12-21', '0900-000-0047', 'Toril, Davao City', 'TTORIL3101'],
            ['Evelyn', 'Diaz', 'Bautista', '1987-06-14', '0900-000-0048', 'Toril, Davao City', 'TTORIL3101'],
            ['Alfredo', 'Rivera', 'Santos', '1982-04-16', '0900-000-0049', 'Toril, Davao City', 'TTORIL3101'],
            ['Diana', 'Castillo', 'Reyes', '1996-10-28', '0900-000-0050', 'Toril, Davao City', 'TTORIL3101'],
            ['Mariano', 'Gonzales', 'Garcia', '1977-01-23', '0900-000-0051', 'Toril, Davao City', 'TTORIL3101'],
            ['Cecilia', 'Aguilar', 'Fernandez', '1985-08-04', '0900-000-0052', 'Toril, Davao City', 'TTORIL3101'],
            ['Ernesto', 'Manalo', 'Perez', '1990-12-19', '0900-000-0053', 'Toril, Davao City', 'TTORIL3101'],
            ['Sylvia', 'Ortega', 'Mendoza', '1983-05-11', '0900-000-0054', 'Toril, Davao City', 'TTORIL3101'],
            ['Arturo', 'Salazar', 'Dela Cruz', '1979-09-02', '0900-000-0055', 'Toril, Davao City', 'TTORIL3101'],

            // Additional members distributed across churches
            ['Rebecca', 'Valdez', 'Lopez', '1997-03-27', '0900-000-0056', 'Poblacion, Kapatagan', 'TKAPAT3501'],
            ['Samuel', 'Cruz', 'Navarro', '1986-02-14', '0900-000-0057', 'Cabadiangan, Davao del Sur', 'TCABAD2401'],
            ['Josephine', 'Reyes', 'Torres', '1992-07-08', '0900-000-0058', 'Anonang, Davao del Sur', 'TANONA0601'],
            ['Marvin', 'Garcia', 'Flores', '1981-11-22', '0900-000-0059', 'Poblacion, Malalag', 'TMALAL1101'],
            ['Helen', 'Mendoza', 'Aquino', '1988-04-13', '0900-000-0060', 'Lower Santa Maria, Davao del Sur', 'TSANTA3701'],
            ['Rogelio', 'Santos', 'Bautista', '1973-06-29', '0900-000-0061', 'Toril, Davao City', 'TTORIL3101'],
            ['Amelia', 'Rivera', 'Castillo', '1995-10-17', '0900-000-0062', 'Poblacion, Kapatagan', 'TKAPAT3501'],
            ['Noel', 'Fernandez', 'Ramos', '1984-01-06', '0900-000-0063', 'Cabadiangan, Davao del Sur', 'TCABAD2401'],
            ['Liza', 'Navarro', 'Morales', '1991-08-31', '0900-000-0064', 'Anonang, Davao del Sur', 'TANONA0601'],
            ['Dominic', 'Perez', 'Villanueva', '1987-12-09', '0900-000-0065', 'Toril, Davao City', 'TTORIL3101'],
        ];

        foreach ($members as $data) {
            [
                $firstName,
                $middleName,
                $lastName,
                $dateOfBirth,
                $phoneNo,
                $address,
                $churchCode,
            ] = $data;

            if (! isset($churches[$churchCode])) {
                throw new RuntimeException(
                    "Church with code {$churchCode} does not exist. Run ChurchSeeder first."
                );
            }

            Member::updateOrCreate(
                [
                    'first_name'    => $firstName,
                    'middle_name'   => $middleName,
                    'last_name'     => $lastName,
                    'date_of_birth' => $dateOfBirth,
                ],
                [
                    'phone_no'  => $phoneNo,
                    'address'   => $address,
                    'church_id' => $churches[$churchCode],
                ]
            );
        }
    }
}
