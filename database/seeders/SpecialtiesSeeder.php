<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            'Neurología',
            'Quirúrgica',
            'Fisioterapia',
            'Pediatría',
            'Cardiología',
            'Urología',
            'Medicina forense',
            'Dermatología',
            'Odontología'
        ];

        foreach ($specialties as $specialty) {
            Specialty::create([
                'name' => $specialty
            ]);
        }
    }
}
