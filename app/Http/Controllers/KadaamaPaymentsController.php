<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\KadaamaApplication;
use App\Models\KadaamaPayment;
use App\Models\Payment;
use Illuminate\Http\Request;

class KadaamaPaymentsController extends Controller
{
    //
    public function index(){

        return view("pages/kadaama_payment/index",[
            "payments"=>KadaamaPayment::all()->map(function ($payment){
                $payment->application = KadaamaApplication::find($payment->application_id);
                $payment->applicant = Applicant::find($payment->application->user_id);
                return $payment;
            })
        ]);
    }

    public function accept(Request $request,$id){

        $kadaamaPayment = KadaamaPayment::find($id);
        $kadaamaPayment->status = "approved";
        $kadaamaPayment->save();

        $payment = Payment::find($kadaamaPayment->payment_id);
        $payment->status = "approved";
        $payment->save();

        return redirect("kadaama/payments");

    }

    public function decline(Request $request,$id){

        $kadaamaPayment = KadaamaPayment::find($id);
        $kadaamaPayment->status = "declined";
        $kadaamaPayment->save();

        $payment = Payment::find($kadaamaPayment->payment_id);
        $payment->status = "declined";
        $payment->save();

        return redirect("kadaama/payments");
    }

    public function pending(Request $request,$id){

        $kadaamaPayment = KadaamaPayment::find($id);
        $kadaamaPayment->status = "pending";
        $kadaamaPayment->save();

        $payment = Payment::find($kadaamaPayment->payment_id);
        $payment->status = "pending";
        $payment->save();

        return redirect("kadaama/payments");
    }

    public function review($id){

        $kadaamaPayment = KadaamaPayment::find($id);
        $application = KadaamaApplication::find($kadaamaPayment->application_id);
        $applicant = Applicant::find($application->user_id);
        $payment = Payment::find($kadaamaPayment->payment_id);

        return view("pages/kadaama_payment/review",[
            "kadaamaPayment"=>$kadaamaPayment,
            "application"=>$application,
            "applicant"=>$applicant,
            "payment"=>$payment,
        ]);
    }
}
