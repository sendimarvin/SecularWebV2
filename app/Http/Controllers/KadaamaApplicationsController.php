<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\KadaamaApplication;
use App\Models\KadaamaApplicationReview;
use App\Models\User;
use Illuminate\Http\Request;

class KadaamaApplicationsController extends Controller
{
    //

    public function index(){

        return view("pages/kadaama/applications",[
            "kadaama_applications"=>KadaamaApplication::all()
        ]);
    }
    public function accept(Request $request,$id){

        $application = KadaamaApplication::find($id);
        $applicant = Applicant::find($application->user_id);

        return view("pages/kadaama/applications_accept",[
            "application"=>$application,
            "applicant"=>$applicant,
            "yearly_payment" => 200000
        ]);
    }
    public function approve(Request $request,$id){

        $application = KadaamaApplication::find($id);
        $applicant = Applicant::find($application->user_id);

        return view("pages/kadaama/applications_approve",[
            "application"=>$application,
            "applicant"=>$applicant,
            "yearly_payment" => 200000
        ]);
    }
    public function decline(Request $request,$id){

        $application = KadaamaApplication::find($id);
        $applicant = Applicant::find($application->user_id);

        return view("pages/kadaama/applications_decline",[
            "application"=>$application,
            "yearly_payment" => 200000,
            "applicant"=>$applicant
        ]);
    }

    public function acceptStore(Request $request,$id){

        $application = KadaamaApplication::find($id);
        $application->payment_yearly = $request->input("payment_yearly");
        $application->payment_full = $request->input("payment_full");
        $application->payment_date = $request->input("payment_date");
        $application->next_payment_date = $request->input("next_payment_date");
        $application->status = "processing";
        $application->payment_sofar = "0";
        $application->save();

        KadaamaApplicationReview::create([
            "review" => $request->input("review"),
            "state" => "processing",
            "admin_id" => "1",
            "application_id" => $id
        ]);

        //send out a notification to the user

        return redirect(url("/kadaama/applications"));
    }

    public function approveStore(Request $request,$id){

        $application = KadaamaApplication::find($id);
        $application->status = "approved";
        $application->save();

        KadaamaApplicationReview::create([
            "review" => $request->input("review"),
            "state" => "approved",
            "admin_id" => "1",
            "application_id" => $id
        ]);

        //send out a notification to the user

        return redirect(url("/kadaama/applications"));
    }
    public function declineStore(Request $request,$id){

        $application = KadaamaApplication::find($id);
        $application->status = "declined";
        $application->save();

        KadaamaApplicationReview::create([
            "review" => $request->input("review"),
            "state" => "declined",
            "admin_id" => "1",
            "application_id" => $id
        ]);

        //send out a notification to the user

        return redirect(url("/kadaama/applications"));
    }

    public function review(Request $request,$id){

        $application = KadaamaApplication::find($id);
        $applicant = Applicant::find($application->user_id);

        return view("pages/kadaama/applications_review",[
            "application"=>$application,
            "applicant"=>$applicant
        ]);
    }
    public function preview(Request $request,$id){

        $application = KadaamaApplication::find($id);
        $applicant = Applicant::find($application->user_id);

        return view("pages/kadaama/applications_preview",[
            "application"=>$application,
            "applicant"=>$applicant,
            "reviews"=>KadaamaApplicationReview::where("application_id","=",$id)->get()
        ]);
    }
}
