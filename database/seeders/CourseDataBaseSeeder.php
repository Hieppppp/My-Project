<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Course::factory()->count(30)->create();
        $this->createCourse();
    }

    public function createCourse()
    {
        Course::create([
            'name' => 'NodeJS',
            'description' => 'Eum cum et eaque eaque officia modi asperiores consectetur.',
            'start_date' => '2024-07-02',
            'end_date' => '2024-09-11',
        ]);
    }
}
