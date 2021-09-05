<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\LoanApplication;
use App\Models\LoanPackage;
use App\Models\LoanPayment;
use App\Models\LoanSubPackage;
use App\Models\Payment;
use Illuminate\Http\Request;

class LoanPaymentsController extends Controller
{
    //
    public function index(){
        $loanPayments = LoanPayment::all()->map(function ($loanPayment){
            $loanPayment->payment = Payment::find($loanPayment->payment_id);
            $loanPayment->application = LoanApplication::find($loanPayment->application_id);

            $loanPayment->sub_package = LoanSubPackage::find($loanPayment->application->subpackage_id);
            $loanPayment->package = LoanPackage::find($loanPayment->sub_package->loan_package_id);

            $loanPayment->applicant = Applicant::find($loanPayment->application->user_id);
            return $loanPayment;
        });

        return view("pages.loans_payment.index",[
            "loanPayments"=>$loanPayments
        ]);
    }

    public function editSubmit(Request $request, $id){
        $status = $request->input("status");

        $loanPayment = LoanPayment::find($id);

        $payment = Payment::find($loanPayment->payment_id);
        $payment->status = $status;
        $payment->save();

        $application = LoanApplication::find($loanPayment->application_id);
        if ($status=="approved"){
            $nextPaymentDate = date('Y-m-d', strtotime($application->nextPaymentDate. ' + '.$application->paymentInterval.' days'));

            $paymentSofar = $payment->amount + $application->paymentSofar;
            $application->nextPaymentDate = $nextPaymentDate;
            $application->paymentSofar = $paymentSofar;

            if ($application->paymentSofar == $application->paymentFull){
                $application->loan_status = "Paid";
            }

            $application->save();
        }

        (new NotificationsController())->sendNotificationToOnePerson("Loan Payment Updated","Your Loan Payment Has been {$status}",$application->user_id);

        return redirect("loans/payments");

    }
    public function edit($id){

        $loanPayment = LoanPayment::find($id);
        $loanPayment->payment = Payment::find($loanPayment->payment_id);
        $application = LoanApplication::find($loanPayment->application_id);

        $loan_sub_package = LoanSubPackage::find($application->subpackage_id);
        $loan_package = LoanPackage::find($loan_sub_package->loan_package_id);

        $applicant = Applicant::find($application->user_id);

        return view("pages.loans_payment.edit",[
            "loanPayment"=>$loanPayment,
            "applicant"=>$applicant,
            "loan_package"=>$loan_package,
            "loan_sub_package"=>$loan_sub_package,
            "application"=>$application,
        ]);

    }
}
