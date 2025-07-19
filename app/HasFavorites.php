<?php

namespace App;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

trait HasFavorites
{
    /**
     * Проверяет, добавлен ли курс в избранное указанным пользователем.
     *
     * @param  int  $courseId
     * @param  User  $user
     * @return bool
     */
    public function isFavorite(int $courseId, User $user = null): bool
    {
        $user = $user ?: Auth::user();

        if (!$user) {
            return false;
        }

        return Favorite::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->exists();
    }
}
