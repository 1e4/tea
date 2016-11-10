<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drinks extends Model
{
    /**
     * Disable timestamps
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Force attribute casting
     * 
     * @var array
     */
    protected $casts = [
        'busy'  =>  'integer'
    ];
}
