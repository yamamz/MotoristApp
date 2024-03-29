<?php


namespace App\Http\Controllers\accounting;
use App\Http\Controllers\Controller;
use App\MemberLoan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class MemberLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $loans=MemberLoan::with('member','loanPayments')->get();
       return $loans->toArray();
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

     public function memberHasLoan()
     {
         
     }

    public function store(Request $request)
    {
        $date=date_create($request->date_release);
        $date_format=date_format($date,"Y/m/d");
        $attrs=[
            'member_id'=>$request->member_id,
            'term_id'=>$request->term_id,
           'principal_amount'=>$request->principal_amount,
          'interest_rate'=>$request->interest_rate,
            'due_date'=>$request->due_date,
           'date_release'=>$date_format,
         'total_amount_due'=>$request->total_amount_due,
         'is_paid'=>$request->is_paid,
        ];
        $loan=MemberLoan::create($attrs);
        return $loan;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loan=MemberLoan::with('member','loanPayments')->find($id);
        return $loan->toArray();
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
        $loan=MemberLoan::find($id);
        $date=date_create($request->date_release);
        $date_format=date_format($date,"Y/m/d");
        $loan->member_id=$request->member_id;
        $loan->term_id=$request->term_id;
        $loan->principal_amount=$request->principal_amount;
        $loan->interest_rate=$request->interest_rate;
        $loan->due_date=$request->due_date;
        $loan->date_release=$date_format;
        $loan->total_amount_due=$request->total_amount_due;
        $loan->save();
        return $loan;
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $loan=MemberLoan::findOrFail($id);
            $loan->delete();
            return response()->json([
                "ok" => true
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                "ok" => false
            ], 200);
        }
    }
}
