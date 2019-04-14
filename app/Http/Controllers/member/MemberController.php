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
    $pnode=Member::find($id);
    $node=Member::whereDescendantOrSelf($pnode)->get()->toTree();
    return $node;
}
public function getNodeToTreeFlat($id){
    $node=Member::descendantsAndSelf($id)->toFlatTree();
    return $node;
}

public function show($id)
{
    $member=Member::find($id);
    $result = Member::descendantsOf($id)->toFlatTree();

    return response()->json([
        "member" => $member,
        "num_downLines"=>count($result)
    ], 200);
}


public function store(Request $request)
{

    $parent_id=$request->parent_id;
    
    if($parent_id == null)
    {
       
        $title=$request->first_name.' '.$request->last_name;
        $name='';
        $attrs=[
        'name'=> $name,
        'title'=>$title,
        'first_name'=>$request->first_name,
        'middle_name'=> $request->middle_name,
        'last_name'=> $request->last_name,
        'mobile_no'=> $request->mobile_no,
        'age'=>$request->age,
        'address'=>$request->address,
        'birthdate'=>$request->birthdate,
        'registration'=>$request->registration,
        'monthly_amortization'=>$request->monthly_amortization,
        'image'=>$request->image,
        'className'=>'Pending'
        ];
        $member=new Member($attrs);
        $member->save();
        $member->name="ID-".$member->id;
        $member->save();
        
    }
    else{
        $parent=Member::find($parent_id);
        $title=$request->first_name.' '.$request->last_name;
        $name='';
        $attrs=[
        'name'=> $name,
        'title'=>$title,
        'first_name'=>$request->first_name,
        'middle_name'=> $request->middle_name,
        'last_name'=> $request->last_name,
        'mobile_no'=> $request->mobile_no,
        'age'=>$request->age,
        'address'=>$request->address,
        'birthdate'=>$request->birthdate,
        'registration'=>$request->registration,
        'monthly_amortization'=>$request->monthly_amortization,
        'image'=>$request->image,
        'className'=>'Pending'
        ];
        $member=Member::create($attrs,$parent);
        $member->name="ID-".$member->id;
        $member->save();

        $result = Member::whereDescendantOf($parent)->get();

        $countChilds=count($result);

        if($countChilds >= 2)
        {
            $parent->className="ToRelease";
            $parent->save();
        }
        

    }

    return $member;

}
}
