<?php

namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class MemberController extends Controller
{


public function index()
{
    $members=Member::all();
    return $members;
}
public function getAllTree(){
    $members=Member::get()->toTree();
    return $members; 
}
public function getNodeToTree($id){
    $node=Member::descendantsAndSelf($id)->toTree();
   
    return $node;
}


public function store(Request $request)
{

    $parent_id=$request->parent_id;
    if($parent_id == null)
    {
        $attrs=['first_name'=>$request->first_name,
        'middle_name'=> $request->middle_name,
        'last_name'=> $request->last_name,
        'mobile_no'=> $request->mobile_no,
        'age'=>$request->age,
        'address'=>$request->address,
        'birthdate'=>$request->birthdate,
        'registration'=>$request->registration,
        'monthly_amortization'=>$request->monthly_amortization,
        'matrix_position'=>$request->matrix_position
        ];
        $member=new Member($attrs);
        $member->save();
    }
    else{
        $parent=Member::find($parent_id);
        $attrs=['first_name'=>$request->first_name,
        'middle_name'=> $request->middle_name,
        'last_name'=> $request->last_name,
        'mobile_no'=> $request->mobile_no,
        'age'=>$request->age,
        'address'=>$request->address,
        'birthdate'=>$request->birthdate,
        'registration'=>$request->registration,
        'monthly_amortization'=>$request->monthly_amortization,
        'matrix_position'=>$request->matrix_position
        ];
        $member=Member::create($attrs,$parent);

    }

    return $member;

}
}
