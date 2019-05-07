<?php

namespace App\Http\Controllers\accounting;
use App\Http\Controllers\Controller;
use App\LoanPayment;
use App\MemberLoan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoanPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all=MemberLoan::with('memberLoan')->all();
        return $all->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $date=date_create($request->date_release);
    $date_format=date_format($date,"Y/m/d");
        $attrs=['member_loan_id'=>$request->member_loan_id,
                'date_of_payment'=>$date_format,
                'beginning_balance'=>$request->beginning_balance,
                'paid_interest'=>$request->paid_interest,
                'paid_principal'=>$request->paid_principal,
                'ending_balance'=>$request->ending_balance
                ];

        $payment=LoanPayment::create($attrs);
        $loan=MemberLoan::findOrFail($payment->member_loan_id);
        if($payment->ending_balance==0){
   
            $loan->is_paid=true;
            $loan->save();
        }
        else{
            $loan->is_paid=false;
            $loan->save();
        }
        return $payment;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
