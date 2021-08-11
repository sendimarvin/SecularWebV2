<?php

namespace App\Http\Controllers;

use App\Models\ApplicationMeeting;
use App\Models\LoanApplication;
use Illuminate\Http\Request;

class ApplicationMeetingController extends Controller
{
    //
    function meetingEdit(Request $request,$id){
        $meeting = ApplicationMeeting::find($id);
        $application = LoanApplication::find($meeting->application_id);

        $meeting->status = $request->input("status");
        $meeting->remarks = $request->input("remarks");
        $meeting->save();

        $message = "The {$meeting->type} Loan Application Meeting schedule for {$meeting->meeting_date} at {$meeting->meeting_time} has been {$meeting->status}. Open the app for more details";
        (new NotificationsController())->sendNotificationToOnePerson("Loan Meeting Updated",$message,$application->user_id);

        return redirect("/loans/applications/review/{$meeting->application_id}");
    }

}
