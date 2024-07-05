<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->count(20)->create();
        $this->createAdminUser();
    }

    public function createAdminUser()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin.example@gmail.com',
            'password' => bcrypt('123456789'),
            'date_of_birth' => '2003-07-02',
            'phone' => '09999999999',
            'avatar' => '1718272414.jpg',
        ])->roles()->sync(Role::where('name', UserRole::ADMIN)->first()->id);
    }
}
