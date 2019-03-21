<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $fillable = [
        'headline', 'content', 'user_id', 'rating',
    ];

    protected $attributes = [
        'tv_imdb_id' => null,
        'movie_imdb_id' => null,
        'rating' => null
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
