<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseUser;

class ItemCourseController extends Controller
{
    public function show(Course $course)
    {
        $isEnrolled = CourseUser::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->exists();

        return view('course.course', compact('course', 'isEnrolled'));
    }
}
