<?php

namespace App\Http\Controllers;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exam = Exam::all();

        return response()->json(['status' => 'success', 'data' => $exam], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request ->all(),[
            'exam_name' => 'required|regex:/^[a-zA-Z- ]*$/',
            'exam_year' => 'required|regex:/^[0-9]*$/',
         ]);

           // If validation fails, return a JSON response with validation errors
      if ($validator->fails()) {
         return response()->json(['message' => $validator->errors()], 422);
             }

         $exam_name = $request->exam_name;
         $exam_year = $request->exam_year;

      // Save question to database
          $examData = new Exam;
          $examData->exam_name = $exam_name;
          $examData->year = $exam_year;
          $examData->save();    

        return response()->json(['message' => 'Exam Information Added Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->input('id');

        if (!$id) {
            return response()->json(['status' => 0, 'message' => 'Please provide an id.'], 400);
        }

        $exam = Exam::where('id', $id)->get();

        if ($exam) {
            return response()->json(['status' => 'success', 'data' => $exam], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Data not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = validator::make($request ->all(),[
            'exam_name' => 'required|regex:/^[a-zA-Z- ]*$/',
            'year' => 'required|regex:/^[0-9]*$/',
            'id' => 'regex:/^[0-9]*$/',
         ]);

           // If validation fails, return a JSON response with validation errors
      if ($validator->fails()) {
         return response()->json(['message' => $validator->errors()], 422);
             }
     
              // Process the validated data and insert into the database
     $id = $request->input('id');
     $examName = $request->exam_name;  
     $year = $request->year;

     if (!$examName) {
         return response()->json(['status' => 0, 'message' => 'Please provide an id.'], 400);
     }
 
     // Update data from the database 
 
     $updateData = Exam::where('id', $id)->update([
         'exam_name' => $examName,
         'year' => $year,
     ]);
 
     // Return a JSON response indicating success
     return response()->json(['message' => 'Data updated successfully'], 200); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');

        if (!$id) {
            return response()->json(['status' => 0, 'message' => 'Please provide an id.'], 400);
        }
    
        $deleted = Exam::where('id', $id)->delete();
    
        if ($deleted) {
            return response()->json(['status' => 1, 'message' => 'Data deleted successfully.']);
        } else {
            return response()->json(['status' => 0, 'message' => 'There is an error to deleting the data.'], 500);
        }
    }
}
