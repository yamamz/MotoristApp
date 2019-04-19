<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
class Member extends Model
{
    protected $guarded=[];
    use NodeTrait;

    public function motorRelease()
    {
        return $this->hasOne('App\MotorRelease');
    }
}
