<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberLoan extends Model
{
    protected $guarded=[];
    
    public function member(){
        return $this->belongsTo('App\Member');
    }
    public function loanPayments()
    {
        return $this->hasMany('App\LoanPayment');
    }
}
