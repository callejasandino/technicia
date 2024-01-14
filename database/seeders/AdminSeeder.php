<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Miguel',
            'last_name' => 'Calleja',
            'contact_number' => '09062608928',
            'email' => 'callejasandino@gmail.com',
            'password' => Hash::make('BackEndDev322!'),
        ]);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => 1,
        ]);
    }
}
