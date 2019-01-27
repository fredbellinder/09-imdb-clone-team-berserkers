<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photoseries extends Model
{
    protected $table = 'photoseries';
    
    public function series()
    {
        return $this->belongsTo(Series::class);
    }
}
