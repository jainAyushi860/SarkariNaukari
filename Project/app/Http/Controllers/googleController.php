<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use App\Models\GoogleData;
use Hash;
use Auth;
use Validator;
// use Illuminate\Support\Facades\Input;
// use Redirect;



class googleController extends Controller
{

  /// for google login

    public function googleLogin(){
       return Socialite::driver('google')->redirect();
    }
    
    public function googleHandle(){
        try{
      $userlogin = Socialite::driver('google')->user();

      $findUser = GoogleData::where('email',$userlogin->getEmail())->first();

      if(!$findUser){

    $saveuser = GoogleData::updateOrCreate([
        'google_id'=>$userlogin->getId(),
    ],[
            'name' => $userlogin->getName(),
            'email' => $userlogin->getEmail(),
            // 'mobile' => $userlogin->mobile,
            // 'dob' =>    $userlogin->dob,
            // 'gender' => $userlogin->gender,
            'password' => Hash::make($userlogin->getName().'@'.$userlogin->getId()),
            'status' => 'Active',
            'token'=> $userlogin->token
    ]);
    Auth::login($saveuser);
    return redirect('/home');
  
      }
      else{

        $saveuser = GoogleData::where('email',$userlogin->getEmail())->update([
            'google_id' => $userlogin->getId(),
        ]);
        $saveuser = GoogleData::where('email',$userlogin->getEmail())->first();  
      }
      

   
      Auth::login($findUser);
      return redirect('/home');
    //    dd($user);
        } catch(Exception $e){
            dd($e->getMessage());
            // return redirect('/login');
        }
    }


    /// for google captcha
    public function getuser(){
      return view('google');
   }
    public function formstore(Request $request){
      
      // $validator = Validator::make($request->all(), [
      //   'name' => 'required|regex:/^[a-zA-Z- ]*$/',
      //   'email' => 'required|email|max:100|unique:signup',
      //   'mobile' => 'required|regex:/^[0-9]{10}+$/',
      //   'dob' => 'required|regex:/^(\d{4})-(\d{2})-(\d{2})$/',
      //   'gender' => 'required|in:Male,Female,Other,male,female,other',
      //   'password' => 'required|string|min:6|max:8',
      //   'g-recaptcha-response' => 'required|captcha',   
      // ]);
        

      $request->validate([
        'name' => 'required|regex:/^[a-zA-Z- ]*$/',
        'email' => 'required|email|max:100|unique:signup',
        'mobile' => 'required|regex:/^[0-9]{10}+$/',
        'dob' => 'required|regex:/^(\d{4})-(\d{2})-(\d{2})$/',
        'gender' => 'required|in:Male,Female,Other,male,female,other',
        'password' => 'required|string|min:6|max:8',
        'g-recaptcha-response' => 'required|captcha', 
    ]);
              //       ],
    //        [
    // 'name.required' => 'The name field is required.',
    // 'name.regex' => 'The name field must contain only letters, hyphens, and spaces.',
    // 'email.required' => 'The email field is required.',
    // 'email.email' => 'Please enter a valid email address.',
    // 'mobile.required' => 'The mobile field is required.',
    // 'mobile.regex' => 'The mobile field must be exactly 10 digits long and contain only numbers.',
    // 'dob.required' => 'The date of birth field is required.',
    // 'dob.regex' => 'The date of birth must be in the format YYYY-MM-DD.',
    // 'gender.required' => 'The gender field is required.',
    // 'gender.in' => 'Please select a valid gender.',
    // 'password.required' => 'The password field is required.',
    // 'password.regex' => 'The password must contain at least 1 lowercase letter, 1 uppercase letter, 1 digit, 1 special character, and be at least 8 characters long.',
        

         // If validation fails, return a JSON response with validation errors
        // if ($validator->fails()) {
        //     return response()->json(['message' => $validator->errors()], 422);
        // }
            $user =  GoogleData::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'status' => 'Active',
             ]);
             return response()->json([
               'status' => 1,
               'message'=> 'User registered successfully',
               'user'=> $user
             ]);

    //        // Check if the email already exists
//         $email = $request->email; 
//       $emailVerify = Signup::where('email', $email)->exists();

//           if ($emailVerify) {
//               return response()->json(['message' => 'This email is already being used']);
//             }
//           else{
//          // Insert data into the database
//       $signupData = new Signup;

//       $signupData->name = $request->name;
//       $signupData->email = $request->email;
//       $signupData->mobile = $request->mobile;
//       $signupData->dob =  $request->dob;
//       $signupData->gender = $request->gender;
//       $signupData->password = md5($request->password);
//       $signupData->status = 'Active';
//       $signupData->created_at = now();
//       $signupData->save();
  
//   // Return a JSON response indicating success
//   return response()->json(['message' => 'Data saved successfully'], 200);
//           }
    }
}
