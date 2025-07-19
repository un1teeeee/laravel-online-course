<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::create([
            'title' => 'Основы Laravel',
            'description' => 'Введение в фреймворк Laravel',
            'prog_language' => 'Laravel',
        ]);

        Lesson::create([
            'course_id' => $courses->id,
            'title' => 'Что такое Laravel',
            'content' => 'Laravel - это мощный PHP-фреймворк'
        ]);
    }
}
