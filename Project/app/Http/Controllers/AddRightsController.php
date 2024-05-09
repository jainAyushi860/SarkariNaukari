<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddRights;

class AddRightsController extends Controller
{
    /// for google captcha
    public function getrights(){
        return view('addrights');
     }

     public function store(Request $request){
        // Validate the incoming request data
        $request->validate([
          'rights' => 'required|regex:/^[a-zA-Z- ]*$/',   
       ]);



         $userRights = new AddRights;
         $userRights->rights = $request->rights;
         $userRights->save();
     
         return redirect('addrole')->with('message','Rights added successfully..');
  }
}
