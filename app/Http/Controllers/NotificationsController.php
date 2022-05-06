<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    //

    public function upload(Request $request){

        $this->sendNotificationToOnePerson("Greetings","Another 1",$request->input("id"));

        dd("Finish");
    }

    public function sendNotificationToOnePerson($title, $content, $user_id){

        Notification::create([
            "title" => $title,
            "content" => $content,
            "user_id" => $user_id]);

        $user = Applicant::where("id","=",$user_id)->get()->first();

        if($user!=null  && $user->playerId!=""){
            (new OneSignalController())->sendOneSignalNotificationToOne($title,$content,$user->playerId);
        }

    }

    public function send_notification_to_person(Request $request){

        $title = null;
        $message = null;

        if ($request->method() == "POST"){

            $applicant_id = $request->input("applicant_id");
            $notification_title = $request->input("notification_title");
            $notification_message = $request->input("notification_message");

            $this->sendNotificationToOnePerson($notification_title,$notification_message,$applicant_id);

            $applicant = Applicant::find($applicant_id);
            $name = $applicant->firstName." ".$applicant->lastName;

            $title = "Notification has been sent Successfully !";
            $message = "Person Name: $name | Notification Title : $title, Notification Message : $message";
        }

        return view('pages/notification_to_user', [
            "applicants"=>Applicant::orderBy("id","DESC")->get(),
            "info_title"=>$title,
            "info_message"=>$message
        ]);
    }

}
