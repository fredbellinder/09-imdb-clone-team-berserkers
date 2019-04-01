<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $fillable = [
        'content', 'user_id', 'user_name'
    ];

    protected $attributes = [
        'movie_tmdb_id' => null,
        'approved' => false
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
