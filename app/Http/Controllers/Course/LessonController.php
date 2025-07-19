<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
    /**
     * Отображает страницу урока.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\View\View
     */
    public function show(Lesson $lesson)
    {
        $lesson = Lesson::with('course.lessons')->findOrFail($lesson->id);

        $course = $lesson->course;

        $lessons = $course->lessons;

        return view('lessons.show', compact('lesson', 'lessons', 'course'));
    }
}
