<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
    protected $guarded=[];

    public function memberLoan()
    {
        return $this->belongsTo('App\MemberLoan');
    }
}
