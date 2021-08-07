<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    //

    public function sendNotificationToOnePerson($title, $content, $user_id){

        Notification::create([
            "title" => $title,
            "content" => $content,
            "user_id" => $user_id]);

        $user = Applicant::where("id","=",$user_id)->get()->first();

        if($user!=null  && $user->playerId!=""){
            (new OneSignalController())->sendOneSignalNotificationToOne($title,$content,$user->player_id);
        }

    }
}
