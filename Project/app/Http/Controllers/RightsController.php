<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rights;
use App\Models\UserRole;
use App\Models\AddRole;

class RightsController extends Controller
{

    // public function getrole(){
    //     return view('addrights');
    //  }

     public function showData(){
        $rights = AddRole::select('id','name','permissions')->get();
        return view('addrights',compact('rights'));
      }

  // public function store(Request $request){
    // $request->validate([
    //     'rights'=>'required'
    // ]);
    // // dd($request->all());
    // // $role_id = $request->rights;
    // //  dd($role_id);
    // $userRights = new Rights;
    // // $userRights->role_id = $role_id;
    // $userRights->rights = json_encode($request->rights);
    // $userRights->save();

    // return redirect()->back()->with('message','Rights added successfully!');
  // } 


  // public function checkarr(Request $request){
  //   if(in_array($request,$required)){
     
  //   }
  //   $required = ["Add", "Edit", "View", "Delete"];

  // }
}
