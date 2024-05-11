<?php

namespace App\Http\Controllers;

use App\Models\MockTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MockTestController extends Controller
{
    public function addquestion(Request $request){     
        $validator = validator::make($request ->all(),[
            'question' => 'required|regex:/^[a-zA-Z- ]*$/',
            'option1' => 'required|regex:/^[a-zA-Z- ]*$/',
            'option2' => 'required|regex:/^[a-zA-Z- ]*$/',
            'option3' => 'required|regex:/^[a-zA-Z- ]*$/',
            'option4' => 'required|regex:/^[a-zA-Z- ]*$/',
            'answer' => 'required|regex:/^[a-zA-Z- ]*$/',
            'subjects' => 'required',
            'appear_exam' => 'required',
         ]);

  // If validation fails, return a JSON response with validation errors
  if ($validator->fails()) {
    return response()->json(['message' => $validator->errors()], 422);
   }
        // Save question to database
    
          $input = $request->all();

$subjects = $input['subjects'] ?? [];
$appearExam = $input['appear_exam'] ?? [];

$input['question']= $request->question;
$input['option1']= $request->option1;
$input['option2']= $request->option2;
$input['option3']= $request->option3;
$input['option4']= $request->option4;
$input['answer']=  $request->option4;
$input['subject'] = !empty($subjects) ? implode(',', $subjects) : null;
$input['appearExam'] = !empty($appearExam) ? implode(',', $appearExam) : null;
MockTest::create($input);

        return response()->json(['message' => 'Question added successfully'], 200);  
    }


    public function viewquestion($id){

        $mockTest = MockTest::find($id);

        if (!$mockTest) {
            return response()->json(['message' => 'Mock test not found'], 404);
        }

        return response()->json($mockTest);
        
        // $mockTests = MockTest::select('question', 'option1', 'option2', 'option3', 'option4','answer','subject')->get();
        
        // return response()->json($mockTests);
    }
}
