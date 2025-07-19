<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    /**
     * Отписывает пользователя от курса.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unenroll(Course $course)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Пожалуйста, авторизуйтесь, чтобы отписаться от курса.');
        }

        $user = Auth::user();

        $enrollment = CourseUser::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return redirect()->back()->with('error', 'Вы не записаны на этот курс.');
        }

        DB::table('lesson_user')
        ->where('user_id', $user->id)
            ->whereIn('lesson_id', $course->lessons()->pluck('id')) // Только уроки, принадлежащие этому курсу
            ->delete();

        $enrollment->delete();

        return redirect()->back()->with('success', 'Вы успешно отписались от курса.');
    }

    /**
     * Записывает пользователя на курс и перенаправляет на первый урок.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enrollAndRedirect(Course $course)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Пожалуйста, авторизуйтесь, чтобы записаться на курс.');
        }

        $isEnrolled = CourseUser::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->exists();

        if ($isEnrolled) {
            return redirect()->back()->with('message', 'Вы уже записаны на этот курс.');
        }

        CourseUser::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
        ]);

        $firstLesson = $course->lessons()->orderBy('created_at', 'asc')->first();

        if (!$firstLesson) {
            return redirect()->route('course.course', $course)->with('success', 'Вы успешно записались на курс!');
        }

        return redirect()->route('lessons.show', $firstLesson)->with('success', 'Вы успешно записались на курс!');
    }
}
