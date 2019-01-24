<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    public function directors(){
        return $this->belongsToMany(Director::class);
    }
    public function casts(){
        return $this->belongsToMany(Cast::class);
    }
    public function genres(){
        return $this->belongsToMany(Genre::class);
    }
}
