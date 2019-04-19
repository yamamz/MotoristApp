<?php


namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;
use App\MotorRelease;
use App\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MotorReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motorReleases=MotorRelease::all();
        return $motorReleases;
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
        // $table->float('monthly_due')->nullable();
        // $table->date('date_recieved')->nullable();
        // $table->string('due_date')->nullable();
        // $table->boolean('is_loan')->nullable();

        $date=date_create($request->date_recieved);
        $date_format=date_format($date,"Y/m/d");
        $attrs=[
                'member_id'=>$request->member_id,
                'down_payment'=>$request->down_payment,
                'motor_id'=>$request->motor_id,
                'monthly_due'=>$request->monthly_due,
                'due_date'=>$request->due_date,
                'date_recieved'=>$date_format,
                'is_loan'=>$request->is_loan,
        ];
        $release=MotorRelease::create($attrs);

        $member=Member::find($release->member_id);
        $member->className="Release";
        $member->save();
        return $release;
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
