<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    /**
     * Переключает состояние "избранное" для курса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $courseId
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle(Request $request, int $courseId)
    {
        $course = Course::findOrFail($courseId);
        $user = Auth::user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Курс удален из избранного.';
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
            ]);
            $message = 'Курс добавлен в избранное.';
        }

        return response()->json(['success' => true, 'message' => $message]);
    }
}
