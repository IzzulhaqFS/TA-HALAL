<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Helpers\UuidGenerator;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default credentials
        User::insert([
            [ 
                'id' => UuidGenerator::get(),
                'name' => 'jagadul',
                'email' => 'jagad@mail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'gender' => 'male',
                'phone' => '081122223333',
                'id_card' => 'https://www.linkedin.com/in/jagadwp/',
                'umkm_id' => '99/OK/2012',
                'umkm_name' => 'Jagadul Beverage',
                'umkm_address' => 'Jl. Gading 99',
                'umkm_city' => 'Surabaya',
                'umkm_country' => 'Indonesia',
                'remember_token' => Str::random(10)
            ]
        ]);

        // Fake users
        // User::factory()->times(9)->create();
    }
}
