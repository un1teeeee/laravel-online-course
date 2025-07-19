<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $isFavorite = [];

        foreach ($courses as $course) {
            $isFavorite[$course->id] = $course->isFavorite($course->id);
        }

        return view('course.catalog', compact('courses', 'isFavorite'));
    }

    public function filter(Request $request, $progLanguage)
    {
        if (!in_array($progLanguage, ['PHP', 'Laravel'])) {
            abort(404);
        }

        $courses = Course::query()->where('prog_language', $progLanguage)->get();

        $isFavorite = [];

        if (Auth::check()) {
            $user = Auth::user();

            foreach ($courses as $course) {
                $isFavorite[$course->id] = $course->isFavorite($course->id);
            }
        }

        return view('course.filter', compact('courses', 'progLanguage', 'isFavorite'));
    }
}
