<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Carlos Villatoro',
            'email' => 'carlos@villatoro.dev',
            'DPI' => '2899021420101',
            'phone' => '46414243',
            'address' => '18 av 27-80 zona 4',
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Paciente 1',
            'email' => 'paciente1@villatoro.dev',
            'DPI' => '2899021420505',
            'phone' => '56983214',
            'address' => '15 av 1-30 zona 8',
            'role' => 'paciente'
        ]);

        User::factory()->create([
            'name' => 'Doctor 1',
            'email' => 'doctor@villatoro.dev',
            'DPI' => '2899021420202',
            'phone' => '12569874',
            'address' => '17 av 7-50 zona 15',
            'role' => 'doctor'
        ]);

        User::factory(50)->create();
    }
}
