<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $fillable = [
        'title', 'poster_url', 'user_id', 'year',
    ];

    protected $attributes = [
        'tv_tmdb_id' => null,
        'movie_tmdb_id' => null,
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
