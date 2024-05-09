<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\NotificationDetail;
use App\Models\NotificationSubscribe;

class NotificationController extends Controller
{
    public function addNotification(Request $request) {

        $validator = validator::make($request ->all(),[
            'title' => 'required|regex:/^[a-zA-Z- ]*$/',
            'description' => 'required|regex:/^[a-zA-Z- ]*$/',
            'image' => 'required|mimes:jpg,jpeg,gif,png',
            'remark' => 'required|regex:/^[a-zA-Z- ]*$/',
            'link' => 'required|string|url',
         ],[
            'title.required' => 'The title field is required.',
            'title.regex' => 'The title field must contain only letters, spaces, and hyphens.',
            'description.required' => 'The description field is required.',
            'description.regex' => 'The description field must contain only letters, spaces, and hyphens.',
            'remark.required' => 'The remark field is required.',
            'remark.regex' => 'The remark field must contain only letters, spaces, and hyphens.',
            'link.required' => 'The link field is required.',
            'link.regex' => 'Please provide a valid url.',
        ]);

  // If validation fails, return a JSON response with validation errors
  if ($validator->fails()) {
    return response()->json(['message' => $validator->errors()], 422);
   }


       // Upload image
       $image = $request->file('image');
       $fileName = 'mypic' . mt_rand(10000, 99999) . '_' . time() . '.' . $image->getClientOriginalExtension();
  
   // $image = $request->file('image');
 
  // Save the file to the storage directory
    $path = $image->store('notificationdocument', 'public');

       // Insert data into the database
   $notificationData = new NotificationDetail;

   $notificationData->title = $request->title;
   $notificationData->description = $request->description;
   $notificationData->image = $fileName;
   $notificationData->remark =  $request->remark;
   $notificationData->link =  $request->link;
   $notificationData->created_at = now();
   $notificationData->save();  


    // Return a JSON response indicating success
    return response()->json(['message' => 'Data saved successfully'], 200);

    }

    public function fetchRecords(Request $request) {

        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

         // Query the database using Eloquent
         $query = NotificationDetail::query();
 

        if ($fromDate && $toDate) {
            $notifications = $query->whereBetween('created_at', [$fromDate, $toDate])->get();
        } elseif ($fromDate) {
            $notifications = $query->where('created_at', '>=', $fromDate)->get();
        } elseif ($toDate) {
            $notifications = $query->where('created_at', '<=', $toDate)->get();
        }
            $records = $query->get();
        

        if ($records->count() > 0) {
            return response()->json([
                'data' => $records,
                'status' => 1,
                'message' => 'Records Found',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'No Records Found',
            ]);
        }
    }


    public function subscriptionRecord(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $status = $request->input('status');

        $query = NotificationSubscribe::query();

        if ($fromDate && $toDate && $status) {
            $query->whereBetween('created_at', [$fromDate, $toDate])->where('status', $status);
        } elseif ($fromDate && $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        } elseif ($status) {
            $query->where('status', $status);
        } elseif ($fromDate) {
            $query->where('created_at', '>=', $fromDate);
        } elseif ($toDate) {
            $query->where('created_at', '<=', $toDate);
        }

        $notifications = $query->get();

        if ($notifications->isNotEmpty()) {
            return response()->json([
                'data' => $notifications,
                'status' => 1,
                'message' => 'Records Found',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'No Records Found',
            ]);
        }
    }

}
