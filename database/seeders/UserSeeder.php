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

        User::factory(50)->create();
    }
}
