<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\HasFavorites;

class Course extends Model
{
    use HasFavorites;

    protected $table = 'courses';

    protected $fillable = [
        'title',
        'description',
        'price',
        'prog_language',
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('created_at', 'asc');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
