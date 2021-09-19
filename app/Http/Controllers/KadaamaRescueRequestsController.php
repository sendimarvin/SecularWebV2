<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\KadaamaApplication;
use App\Models\KadaamaApplicationReview;
use App\Models\KadaamaPayment;
use App\Models\KadaamaRescueRequests;
use App\Models\LoanPackage;
use App\Models\LoanSubPackage;
use Illuminate\Http\Request;

class KadaamaRescueRequestsController extends Controller
{
    //
    function index(Request $request){
        return view("pages/kadaama_rescue_requests/index",[
            "requests"=>KadaamaRescueRequests::all()
                ->map(function ($request){
                    $request->applicant = Applicant::find($request->user_id);
                    return $request;
            })
        ]);
    }

    public function preview(Request $request,$id){

        $reqs = KadaamaRescueRequests::find($id);
        $applicant = Applicant::find($reqs->user_id);
        $application = KadaamaApplication::where('user_id',$reqs->user_id)
                        ->orderBy('id',"DESC")
                        ->get()
                        ->first();

        return view("pages/kadaama_rescue_requests/preview",[
            "request"=>$reqs,
            "applicant"=>$applicant,
            "application"=>$application,
            "payments"=>KadaamaPayment::where("application_id","=",$id)->get(),
            "reviews"=>KadaamaApplicationReview::where("application_id","=",$id)->get()
        ]);
    }
    public function update(Request $request,$id){

        $reqs = KadaamaRescueRequests::find($id);

        $title = "";
        $content = "";

        if ($request->status != $reqs->status){
            switch($request->status){
                case "pending" :
                    $title = "Your Kadaama Rescue Request is now Pending";
                    $content = "Comment: ".$request->comment;
                    break;
                case "approved" :
                    $title = "Your Kadaama Rescue Request is Approved";
                    $content = "Comment: ".$request->comment;
                    break;
                case "declined" :
                    $title = "Your Kadaama Rescue Request is Declined";
                    $content = "Comment: ".$request->comment;
                    break;
            }

            if ($title!=""){
                $reqs->status = $request->status;
                $reqs->comment = $request->comment;
                $reqs->update();

                //send notification to applicant
                (new NotificationsController())->sendNotificationToOnePerson($title,$content,$reqs->user_id);
            }
        }

        return back();
    }
}
