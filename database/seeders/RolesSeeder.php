<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Admin',
            'Client Admin',
            'Client',
        ];

        foreach($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        };
        
    }
}
