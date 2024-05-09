<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddRole;
use App\Models\UserRole;
use Validator;


class AddRoleController extends Controller
{
      /// for google captcha
      public function getrole(){
        return view('addrole');
     }

     public function store(Request $request){
        // Validate the incoming request data
        $request->validate([
          'name' => 'required|regex:/^[a-zA-Z- ]*$/',   
           'rights'=>'required',
       ]);

      // $user = AddRole::create([
      //     'name'=> $request->name,
      //    ]);


         $userRoles = new AddRole;
         $userRoles->name = $request->name;
         $userRoles->permissions = json_encode($request->rights);
         $userRoles->save();
     
         return redirect('addrole')->with('message','Role added successfully..');
  }
 
}
