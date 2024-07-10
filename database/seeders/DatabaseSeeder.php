<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory()->count(20)->create();
        $courses = Course::factory()->count(30)->create();

        foreach ($users as $user) {
            $user->courses()->attach(
                $courses->random(rand(1, 5))->pluck('id')->toArray()
            );
        }
        
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserDataBaseSeeder::class,
        ]);
    }
}
