<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotorRelease extends Model
{
    protected $guarded=[];
    public function member(){
        return $this->belongsTo('App\Member');
    }
}
