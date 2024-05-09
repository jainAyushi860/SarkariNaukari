<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\AddRole;



class ShowUserController extends Controller
{
    public function showData(){
      $roles = AddRole::with('userrole')->get();//userrole is a function name of a model
      $users = UserRole::with('addrole')->get();//addrole is a function name of a model
      return view('viewuser', compact('roles','users'));
      }

}
