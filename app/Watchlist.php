<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    protected $fillable = [
        'title', 'user_id',
    ];

    protected $casts = [
        'list_items' => 'array',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
