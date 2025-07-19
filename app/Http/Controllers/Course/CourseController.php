<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\CourseUser;

class CourseController extends Controller
{
    public function markLessonAsCompleted(Request $request, Lesson $lesson)
    {
        $user = Auth::user();

        $courseUser = CourseUser::where('user_id', $user->id)
            ->where('course_id', $lesson->course_id)
            ->exists();

        if (!$courseUser) {
            return redirect()->back()->with('error', 'Вы не записаны на этот курс.');
        }

        $user->lessons()->syncWithoutDetaching([
            $lesson->id => ['is_completed' => true, 'created_at' => now()]
        ]);

        $this->updateCourseProgress($lesson->course_id, $user);

        $nextLesson = $this->getNextLesson($lesson);

        if ($nextLesson) {
            return redirect()->route('lessons.show', $nextLesson)->with('success', 'Урок пройден! Переходим к следующему.');
        }

        return redirect()->route('courses.show', $lesson->course)->with('success', 'Вы прошли все уроки этого курса!');
    }

    private function getNextLesson(Lesson $lesson)
    {
        $lessons = $lesson->course->lessons()->orderBy('created_at', 'asc')->get();
        $currentLessonIndex = $lessons->search(function ($item) use ($lesson) {
            return $item->id === $lesson->id;
        });

        if ($currentLessonIndex === false || $currentLessonIndex === count($lessons) - 1) {
            return null;
        }

        return $lessons[$currentLessonIndex + 1];
    }

    private function updateCourseProgress(int $courseId, $user)
    {
        $course = Course::findOrFail($courseId);
        $totalLessons = $course->lessons()->count();
        $completedLessons = $user->lessons()->where('course_id', $courseId)->where('is_completed', true)->count();

        $progress = ($totalLessons > 0) ? ($completedLessons / $totalLessons) * 100 : 0;

        $courseUser = CourseUser::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->firstOrFail();

        $courseUser->progress = $progress;
        $courseUser->save();
    }
}
