<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Media;
use Auth;

class MediaController extends Controller
{
    // For Fetching
 public function fetchRecord(Request $request){
    if (auth()->check()) {
     $fromDate = $request->input('fromDate');
     $toDate = $request->input('toDate');

     // Query the database using Eloquent
     $query = Media::query();

     if ($fromDate && $toDate) {
         $query->whereBetween('created_at', [$fromDate, $toDate]);
     } elseif ($fromDate) {
         $query->where('created_at', '>=', $fromDate);
     } elseif ($toDate) {
         $query->where('created_at', '<=', $toDate);
     }

     $records = $query->get();

     if ($records->count() > 0) {
         return response()->json(['data' => $records, 'status' => 1, 'message' => 'Record Found']);
     } else {
         return response()->json(['status' => 0, 'message' => 'No Record Found']);
     }
    } else {
        return response()->json(['message' => 'Not Authorized'], 401);
    }
 }

 // For insertion
 public function store(Request $request) {
 
    if (auth()->check()) {
    // Validate the incoming request data
 $validator = Validator::make($request->all(), [
    'title' => 'required|regex:/^[a-zA-Z- ]*$/',
    'file' => 'required|mimes:jpg,jpeg,gif,png,zip,xlsx,cad,pdf,psd,doc,docx,ppt,pptx,pps,ppsx,odt,xls,mp3,m4a,ogg,wav,mp4,m4v,mov,wmv',
],[
    'title.required' => 'The title field is required.',
    'title.regex' => 'The title field must contain only letters, spaces, and hyphens.',
]);

// If validation fails, return a JSON response with validation errors
if ($validator->fails()) {
    return response()->json(['message' => $validator->errors()], 422);
}

// Process the validated data and insert into the database
$title = $request->title;
$file = $request->file('file');

// Save the file to the storage directory
$path = $file->store('mediadocument', 'public');


   // Insert data into the database
   $mediaData = new Media;

   $mediaData->title = $request->title;
   $mediaData->file = $file->getClientOriginalName();
   $mediaData->file_size = $file->getSize();
   $mediaData->file_type =  $file->getMimeType();
   $mediaData->created_at = now();
   $mediaData->save();  

// Return a JSON response indicating success
return response()->json(['message' => 'Data saved successfully'], 200);
} else {
    return response()->json(['message' => 'Not Authorized'], 401);
}
  }

     // For Updation
     public function update(Request $request)
     {
        if (auth()->check()) {
             // Validate the incoming request data
      $validator = Validator::make($request->all(), [
         'title' => 'required|regex:/^[a-zA-Z- ]*$/',
         'caption' => 'required|regex:/^[a-zA-Z- ]*$/',
         'alternative' => 'required|regex:/^[a-zA-Z\-_. ]+$/',
         'description' => 'required|regex:/^[a-zA-Z- ]*$/',
         'id' => 'regex:/^[0-9]*$/',
      ],[
         'title.required' => 'The title field is required.',
         'title.regex' => 'The title field must contain only letters, spaces, and hyphens.',
         'caption.required' => 'The caption field is required.',
         'caption.regex' => 'The caption field must contain only letters, spaces, and hyphens.',
         'alternative.required' => 'The alternative field is required.',
         'alternative.regex' => 'The alternative field must contain only letters, spaces, and hyphens.',
         'description.required' => 'The description field is required.',
         'description.regex' => 'The description field must contain only letters, spaces, and hyphens.',
         'id.regex' => 'The id field must contain only digits.',
     ]);
 
     // If validation fails, return a JSON response with validation errors
     if ($validator->fails()) {
         return response()->json(['message' => $validator->errors()], 422);
     }
 
     // Process the validated data and insert into the database
     $id = $request->input('id');
     $title = $request->title;
     $caption = $request->caption;
     $alternative = $request->alternative;
     $description = $request->description;
     if (!$id) {
         return response()->json(['status' => 0, 'message' => 'Please provide an id.'], 400);
     }
 
     // Update data from the database 
 
     $updateData = Media::where('id', $id)->update([
         'title' => $title,
         'caption' => $caption,
         'alt_name' => $alternative,
         'description' => $description,
         'created_at' => now(), 
     ]);
 
     // Return a JSON response indicating success
     return response()->json(['message' => 'Data updated successfully'], 200);
    } else {
        return response()->json(['message' => 'Not Authorized'], 401);
    } 
     }


 // For Deletion
public function destroy(Request $request)
{
    if (auth()->check()) {
    $id = $request->input('id');

    if (!$id) {
        return response()->json(['status' => 0, 'message' => 'Please provide an id.'], 400);
    }

    $deleted = Media::where('id', $id)->delete();

    if ($deleted) {
        return response()->json(['status' => 1, 'message' => 'Record deleted successfully.']);
    } else {
        return response()->json(['status' => 0, 'message' => 'There is an error deleting the record.'], 500);
    }
} else {
    return response()->json(['message' => 'Not Authorized'], 401);
}
  }

}
