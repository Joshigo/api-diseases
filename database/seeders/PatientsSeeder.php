<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = [
            [
                'name' => 'Juan',
                'last_name' => 'Perez',
                'ci' => '12345678',
                'phone' => '04141234567',
                'age' => 30,
                'lat' => 10.4806,
                'long' => -66.9036,
                'percentage' => 75.5,
            ],
            [
                'name' => 'Maria',
                'last_name' => 'Gonzalez',
                'ci' => '87654321',
                'phone' => '04147654321',
                'age' => 25,
                'lat' => 10.162,
                'long' => -64.6814,
                'percentage' => 80.0,
            ],
            [
                'name' => 'Carlos',
                'last_name' => 'Ramirez',
                'ci' => '11223344',
                'phone' => '04141231234',
                'age' => 40,
                'lat' => 8.5933,
                'long' => -71.1448,
                'percentage' => 65.3,
            ],
            [
                'name' => 'Ana',
                'last_name' => 'Lopez',
                'ci' => '44332211',
                'phone' => '04149876543',
                'age' => 35,
                'lat' => 10.341,
                'long' => -68.743,
                'percentage' => 90.1,
            ],
            [
                'name' => 'Luis',
                'last_name' => 'Martinez',
                'ci' => '55667788',
                'phone' => '04141239876',
                'age' => 28,
                'lat' => 8.9943,
                'long' => -67.429,
                'percentage' => 70.2,
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}
