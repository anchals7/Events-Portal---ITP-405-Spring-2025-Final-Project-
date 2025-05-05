<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'start_time',
        'end_time',
    ];

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function isFavoritedBy($user)
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }
}
