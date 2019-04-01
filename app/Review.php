<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $fillable = [
        'headline', 'content', 'user_id', 'rating', 'movie_title'
    ];

    protected $attributes = [
        'movie_tmdb_id' => null,
        'rating' => null,
        'approved' => false
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
