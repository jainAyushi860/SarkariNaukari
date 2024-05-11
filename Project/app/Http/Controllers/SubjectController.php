<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $subject = Subject::all();

    return response()->json(['status' => 'success', 'data' => $subject], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->check()) {
        $validator = validator::make($request ->all(),[
            'subject' => 'required|regex:/^[a-zA-Z- ]*$/',
         ]);

           // If validation fails, return a JSON response with validation errors
      if ($validator->fails()) {
         return response()->json(['message' => $validator->errors()], 422);
             }
         $subject = $request->subject;

      // Save question to database
          $subjectData = new Subject;
          $subjectData->subject_name = $subject;
          $subjectData->save();    

        return response()->json(['message' => 'Subject Added Successfully']);
    } else {
        return response()->json(['message' => 'Not Authorized'], 401);
    }
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

        $subject = Subject::where('id', $id)->get();
        // $subject = Subject::find($id);

        if ($subject) {
            return response()->json(['status' => 'success', 'data' => $subject], 200);
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
        if (auth()->check()) {
        $validator = validator::make($request ->all(),[
            'subject_name' => 'required|regex:/^[a-zA-Z- ]*$/',
            'id' => 'regex:/^[0-9]*$/',
         ]);

           // If validation fails, return a JSON response with validation errors
      if ($validator->fails()) {
         return response()->json(['message' => $validator->errors()], 422);
             }
     
              // Process the validated data and insert into the database
     $id = $request->input('id');
     $subjectName = $request->subject_name;

     if (!$subjectName) {
         return response()->json(['status' => 0, 'message' => 'Please provide an id.'], 400);
     }
 
     // Update data from the database 
 
     $updateData = Subject::where('id', $id)->update([
         'subject_name' => $subjectName,
     ]);
 
     // Return a JSON response indicating success
     return response()->json(['message' => 'Subject updated successfully'], 200); 
    } else {
        return response()->json(['message' => 'Not Authorized'], 401);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (auth()->check()) {
        $id = $request->input('id');

        if (!$id) {
            return response()->json(['status' => 0, 'message' => 'Please provide an id.'], 400);
        }
    
        $deleted = Subject::where('id', $id)->delete();
    
        if ($deleted) {
            return response()->json(['status' => 1, 'message' => 'Subject deleted successfully.']);
        } else {
            return response()->json(['status' => 0, 'message' => 'There is an error to deleting the subject.'], 500);
        }
   } else {
        return response()->json(['message' => 'Not Authorized'], 401);
    }
}
 } 