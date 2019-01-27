<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photomovie extends Model
{
    protected $table = 'photomovie';
    
    public function movies()
    {
        return $this->belongsTo(Movie::class);
    }

}
