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
    $members=Member::with('loan','motorRelease')->get();

    return $members;
}
public function allwithTree()
{
    $members=Member::with('loan','motorRelease')->get();
    foreach($members as $item){
            $item['tree'] = Member::with('loan')->descendantsAndSelf($item->id)->toFlatTree();
            foreach($item['tree'] as $i){
                $res=Member::withDepth()->find($i['id']);
                $i['level']=$res->depth;
            }
    }
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
    $flatWithLevel = array();

    $node=Member::with('loan')->descendantsAndSelf($id)->toFlatTree();
    foreach($node as $item){
        $res=Member::withDepth()->find($item['id']);
        $item['level']=$res->depth;
        array_push($flatWithLevel,$item);   
    }
    $result = Member::descendantsOf($id)->toFlatTree();
    return response()->json([
        "member" => $flatWithLevel,
        "num_downLines"=>count($result)
    ], 200);
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

public function update(Request $request, $id){
  //  Member::fixTree();
        if($request->parent_id==null){
            $member=Member::find($id);  
            $member->title=$request->first_name.' '.$request->last_name;
            $member->first_name=$request->first_name;
            $member->middle_name= $request->middle_name;
            $member->last_name=$request->last_name;
            $member->mobile_no= $request->mobile_no;
            $member->age=$request->age;
            $member->address=$request->address;
            $member->birthdate=$request->birthdate;
            $member->registration=$request->registration;
            $member->monthly_amortization=$request->monthly_amortization;
            $member->image=$request->image;
            $member->parent_id=$request->parent_id;
            $member->save();
           // $member->makeRoot()->save();
            return response()->json([
                "ok" => true
            ], 200);
            
        }
        else{
            
            $member=Member::find($id); 
            if($member->parent_id != $request->parent_id) {
                $member->title=$request->first_name.' '.$request->last_name;
                $member->first_name=$request->first_name;
                $member->middle_name= $request->middle_name;
                $member->last_name=$request->last_name;
                $member->mobile_no= $request->mobile_no;
                $member->age=$request->age;
                $member->address=$request->address;
                $member->birthdate=$request->birthdate;
                $member->registration=$request->registration;
                $member->monthly_amortization=$request->monthly_amortization;
                $member->image=$request->image;
                $member->save();
            
                $result = Member::where('parent_id',$request->parent_id)->get();
                $countChilds=count($result);
        
                if($countChilds < 2)
                {
                    $member->parent_id=$request->parent_id;
                    $member->save();
              
                    $result = Member::where('parent_id',$request->parent_id)->get();
                    $countChilds=count($result);
            
                    if($countChilds >= 2)
                    {
                        $parent=Member::find($request->parent_id);
                        $parent->className="ToRelease";
                        $parent->save();
                    }
                    
                    return response()->json([
                        "ok" => true
                    ], 200);
    
                }
                else
                {
                    
                    return response()->json([
                        "ok" => false
                    ], 200);
                }

            }
            else{
                $member->title=$request->first_name.' '.$request->last_name;
                $member->first_name=$request->first_name;
                $member->middle_name= $request->middle_name;
                $member->last_name=$request->last_name;
                $member->mobile_no= $request->mobile_no;
                $member->age=$request->age;
                $member->address=$request->address;
                $member->birthdate=$request->birthdate;
                $member->registration=$request->registration;
                $member->monthly_amortization=$request->monthly_amortization;
                $member->image=$request->image;
                $member->save(); 

                return response()->json([
                    "ok" => true
                ], 200);
            }
    
        
           
        }



}

public function searchbyName(Request $request)
{
    $fullname=$request->first_name.' '.$request->last_name;
    $isExist=Member::where('title',$fullname)->exists();

    return response()->json([
        "exist" => $isExist
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
