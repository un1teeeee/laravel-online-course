<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;

class AdminLessonController extends Controller
{
    /**
     * Отображает список всех уроков для указанного курса.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\View\View
     */
    public function index(Course $course)
    {
        $lessons = $course->lessons()->get();

        return view('admin.lessons', compact('course', 'lessons'));
    }

    public function create(Course $course)
    {
        return view('admin.lessons-create', compact('course'));
    }

    /**
     * Сохраняет новый урок в базе данных для указанного курса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $lesson = new Lesson();
        $lesson->course_id = $course->id;
        $lesson->title = $request->title;
        $lesson->content = $request->content;
        $lesson->save();

        return redirect()->route('lessons.index', $course)->with('success', 'Урок успешно создан.');
    }

    /**
     * Удаляет указанный урок.
     *
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Course $course, Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('lessons.index', $course)->with('success', 'Урок успешно удален.');
    }
}
