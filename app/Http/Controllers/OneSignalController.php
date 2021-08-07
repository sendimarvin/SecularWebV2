<?php

namespace App\Http\Controllers;

use Berkayk\OneSignal\OneSignalFacade;
use Illuminate\Http\Request;

class OneSignalController extends Controller
{

    //
    function sendOneSignalNotificationToAll($title,$content){
        OneSignalFacade::sendNotificationToAll(
            $content,
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null,
            $title
        );
    }
    function sendOneSignalNotificationToOne($title,$content,$player_id){
        OneSignalFacade::sendNotificationToUser(
            $content,
            $player_id,
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null,
            $headings = $title,
            $subtitle = null
        );

    }
}
