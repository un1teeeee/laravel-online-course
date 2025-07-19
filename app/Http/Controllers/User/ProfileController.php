<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseUser;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $activeMenu = $request->input('menu', 'progress');

        $favorites = Favorite::where('user_id', $user->id)->get();

        $isFavorite = [];
        foreach ($favorites as $favorite) {
            $isFavorite[$favorite->course->id] = true;
        }
        $progress = [];
        // Получаем только курсы, на которые записан пользователь
        $courses = $user->courses()->get();

        foreach ($courses as $course) {
            $progress[$course->id] = $course->pivot->progress;
        }
        return view('user.profile', compact('favorites', 'isFavorite', 'activeMenu', 'progress', 'courses'));
    }
}
