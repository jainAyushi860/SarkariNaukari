<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Crypt;
// use App\Models\UserRole;
// use App\Models\AddRole;
// use App\Models\OtpGeneration;
// use Auth;
// use Illuminate\Support\Facades\Hash;
// use Mail;
// use App\Mail\smtpemail;
// use Exception;
// use Twilio\Rest\Client;
// use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
// use Laravel\Socialite\Facades\Socialite;

// class RoleController extends Controller
// { 
//     /// for google captcha
//     public function getuser(){
//       $roles = AddRole::select('id','name')->get();
//       return view('admin', compact('roles'));
//      }

//     //  public function getrole(){
//     //   $roles = Role::query()->select('name');
//     //   return view('admin',compact('roles'));
//     //  }


//      public function store(Request $request){
   
//     //    Validate the incoming request data
//         $request->validate([
//           'username' => 'required|regex:/^[a-zA-Z- ]*$/',
//           'email' => 'required|email|max:100|unique:userrole',
//         // //   'mobile' => 'required|regex:/^[0-9]{10}+$/',
//         // //   'dob' => 'required|regex:/^(\d{4})-(\d{2})-(\d{2})$/',
//         // //   'gender' => 'required|in:Male,Female,Other,male,female,other',
//           'password' => 'required|string|min:6|max:8',
//           'roles' => 'required',
//           'g-recaptcha-response' => 'required|captcha',

//  ]);
// //  $reciever_phone = $request->name;
// //  $roles = AddRole::where('id', $reciever_phone)->first();
//  $name = $request->username;
//  $email = $request->email;
//  $password = Hash::make($request->password);
//  $roles = $request->roles;


//  $userdata = new UserRole;
//  $userdata->name = $name;
//  $userdata->email = $email;
//  $userdata->password = $password;
//  $userdata->roles = $roles;
//  $userdata->status = 'Active';
//  $userdata->save();

// // dd($request->all());





// // $input = $request->all();
// // $roles = $input['roles']; // Assuming 'roles' is an array
// // //$input['roles'] = implode(',', $roles); // Implode roles array into a comma-separated string
// // $input['name']= $request->username;
// // $input['status'] = 'Active'; // Set the status field
// // $input['password'] = Hash::make($request->password); // Set the status field
// // UserRole::create($input);

// return redirect()->back()->with('message','User registered successfully!');



// //  $user = UserRole::create([
// //   'name'=> $request->username,
// //   'email'=> $request->email,
// //   'password'=> Hash::make($request->password),
// //   'role_id' =>  $request->roles,
// //   'status' => 'Active',

// //  ]);
  
//      //  return redirect('admin')->with('message','User registered successfully!');
//   }


//   /// for google login

//   public function googleLogin(){
//     return Socialite::driver('google')->redirect();
//  }

//  public function googleHandle(){
//     try{
//   $userlogin = Socialite::driver('google')->user();

//   $findUser = Signup::where('email',$userlogin->getEmail())->first();

//   if(!$findUser){

// $saveuser = Signup::updateOrCreate([
//     'google_id' => $userlogin->getId(),
// ],[
//         'name' => $userlogin->getName(),
//         'email' => $userlogin->getEmail(),
//         'password' => Hash::make($userlogin->getName().'@'.$userlogin->getId()),
//         'status' => 'Active',
//         'token'=> $userlogin->token
// ]);

// Auth::login($saveuser);
// return redirect('/home');

//   }
//   else{

//     $saveuser = Signup::where('email',$userlogin->getEmail())->update([
//         'google_id' => $userlogin->getId(),
//     ]);
//     $saveuser = Signup::where('email',$userlogin->getEmail())->first();  
//    }

//   Auth::login($findUser);
//   return redirect('/home');

//   } catch(Exception $e){
//         dd($e->getMessage());
//     }
// }

// }
