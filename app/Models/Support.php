<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'supports';

    protected $fillable = ['name', 'phone', 'email', 'user_id', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
