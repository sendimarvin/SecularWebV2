<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\LoanApplication;
use App\Models\LoanApplicationFeePayment;
use App\Models\LoanApplicationReview;
use App\Models\LoanPackage;
use App\Models\LoanPayment;
use App\Models\LoanSubPackage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class LoanApplicationController extends Controller
{

    public function loan_applications () {
            $loan_applications = DB::table('loan_applications')
                ->select('loan_applications.id', 'loan_applications.application_id', 'loan_applications.questions',
                'loan_applications.amount',  'loan_applications.loanRepaymentPlan', 'loan_applications.loanRepaymentPlanDays',
                 'loan_applications.moneyReceptionOption', 'loan_applications.moneyReceptionBank',
                 'loan_applications.moneyReceptionBankAccountNumber', 'loan_applications.moneyReceptionMobileTelecom',
                 'loan_applications.moneyReceptionMobileNumber', 'loan_applications.moneyReceptionAccountNames',
                 'loan_applications.entry_date', 'users.firstName', 'users.middleName' , 'users.lastName'
                 , 'users.phoneNumber', 'users.dob', 'loan_sub_packages.sub_loan', 'loan_packages.loan')
                ->join('users', 'users.id', '=', 'loan_applications.user_id')
                ->join('loan_sub_packages', 'loan_sub_packages.id', '=', 'loan_applications.subpackage_id')
                ->join('loan_packages', 'loan_packages.id', '=', 'loan_sub_packages.loan_package_id')
                ->get();
        return view('pages/loan_applications', compact('loan_applications'));
    }

    public function review_loan ($id) {
        $loan_application = DB::table('loan_applications')
                ->where('id', $id)
                ->first();
        $user = DB::table('users')
                ->where('id', $loan_application->user_id)
                ->first();
        $loan_sub_package = DB::table('loan_sub_packages')
                ->where('id', $loan_application->subpackage_id)
                ->first();
        $loan_package = DB::table('loan_packages')
                ->where('id', $loan_sub_package->loan_package_id)
                ->first();
        $subscription = DB::table('loan_packages')
                ->where('id', $loan_sub_package->loan_package_id)
                ->first();
        $loan_application_fee_payment = DB::table('loan_application_fee_payments')
                ->where('application_id', $loan_application->application_id)
                ->first();
        return view('pages/loan_application_review', compact('loan_application', 'user', 'loan_sub_package',
            'loan_package', 'subscription', 'loan_application_fee_payment'));
    }

    public function index(){

        return view("pages.loans.applications",[
            "applications"=> LoanApplication::all()->map(function ($application){

                $application->user = Applicant::find($application->user_id);
                $application->loan_sub_package = LoanSubPackage::find($application->subpackage_id);
                $application->loan_package = LoanPackage::find($application->loan_sub_package->loan_package_id);

                return $application;
            })
        ]);
    }
    public function reviewSubmit(Request $request,$id){

        $application = LoanApplication::find($id);
        $loan_sub_package = LoanSubPackage::find($application->subpackage_id);

        $review = $request->input("review");
        $loanStatus = $request->input("loanStatus");
        $application->loan_status = $loanStatus;

        if ($loanStatus == "Processing"){
            $interest =$loan_sub_package->interest;
            $interestAmount = ($application->amount* ($loan_sub_package->interest/100) );
            $paymentFull = $application->amount + $interestAmount;
            $paymentInterval = $request->input("paymentInterval");
            $paymentGracePeriod = $request->input("paymentGracePeriod");
            $paymentInstallment = $request->input("paymentInstallment");
            $paymentStartDate = Carbon::now()->addDays($paymentGracePeriod)->toDateString();
            $expectedCompletionDate = Carbon::now()->addDays(((
                ($paymentFull/$paymentInstallment) *$paymentInterval)
                +$paymentGracePeriod))->toDateString();

            $application->interest = $interest;
            $application->interestAmount = $interestAmount;
            $application->paymentGracePeriod = $paymentGracePeriod;
            $application->paymentStartDate = $paymentStartDate;
            $application->nextPaymentDate = $paymentStartDate;
            $application->paymentInterval = $paymentInterval;
            $application->paymentSofar = 0;
            $application->paymentFull = $paymentFull;
            $application->paymentInstallment = $paymentInstallment;
            $application->expectedCompletionDate = $expectedCompletionDate;

        }

        $application->save();

        $this->sendLoanApplicationNotification($application);

        //save Review record
        LoanApplicationReview::create([
            "review" => $review,
            "state" => $loanStatus,
            "admin_id" => "1",
            "application_id" => $id
        ]);

        return redirect("loans/applications");

    }
    public function approveSubmit(Request $request,$id){

        $application = LoanApplication::find($id);
        $loan_sub_package = LoanSubPackage::find($application->subpackage_id);

        $review = $request->input("review");
        $loanStatus = $request->input("loanStatus");
        $application->loan_status = $loanStatus;
        $application->save();

        $this->sendLoanApplicationNotification($application);

        //save Review record
        LoanApplicationReview::create([
            "review" => $review,
            "state" => $loanStatus,
            "admin_id" => "1",
            "application_id" => $id
        ]);

        return redirect("loans/applications");

    }
    public function disburseSubmit(Request $request,$id){

        $application = LoanApplication::find($id);
        $loan_sub_package = LoanSubPackage::find($application->subpackage_id);

        $review = $request->input("review");
        $authorisationCode = $request->input("authorisationCode");

        $loanStatus = $request->input("loanStatus");

        if ($loanStatus=="Disbursed"){
            if ($authorisationCode == "money"){
                $application->loan_status = $loanStatus;
                $application->save();

                $this->sendLoanApplicationNotification($application);

                LoanApplicationReview::create([
                    "review" => $review,
                    "state" => $loanStatus,
                    "admin_id" => "1",
                    "application_id" => $id
                ]);
            }
        }else{
            $application->loan_status = $loanStatus;
            $application->save();

            $this->sendLoanApplicationNotification($application);

            LoanApplicationReview::create([
                "review" => $review,
                "state" => $loanStatus,
                "admin_id" => "1",
                "application_id" => $id
            ]);
        }

        //save Review record

        return redirect("loans/applications");

    }
    public function review($id){

        $application = LoanApplication::find($id);
        if ($application->loan_status == "Processing" ||
            $application->loan_status == "Approved"){
            return redirect("loans/applications/approve/".$id);
        }

        $loan_sub_package = LoanSubPackage::find($application->subpackage_id);
        $loan_package = LoanPackage::find($loan_sub_package->loan_package_id);
        $fee_payment = LoanApplicationFeePayment::where("application_id","=",$application->id)->get()->first();

        return view("pages.loans.review",[
            'fee_payment'=>$fee_payment,
            'application'=>$application,
            'applicant'=>Applicant::find($application->user_id),
            'loan_sub_package'=>$loan_sub_package,
            'loan_package'=>$loan_package,

        ]);
    }
    public function approve($id){

        $application = LoanApplication::find($id);
        $loan_sub_package = LoanSubPackage::find($application->subpackage_id);
        $loan_package = LoanPackage::find($loan_sub_package->loan_package_id);
        $fee_payment = LoanApplicationFeePayment::where("application_id","=",$application->id)->get()->first();

        return view("pages.loans.approve",[
            'fee_payment'=>$fee_payment,
            'application'=>$application,
            'applicant'=>Applicant::find($application->user_id),
            'loan_sub_package'=>$loan_sub_package,
            'loan_package'=>$loan_package,
        ]);
    }
    public function preview($id){

        $application = LoanApplication::find($id);
        $loan_sub_package = LoanSubPackage::find($application->subpackage_id);
        $loan_package = LoanPackage::find($loan_sub_package->loan_package_id);
        $reviews = LoanApplicationReview::where("application_id","=",$id)->get();
        $payments = LoanPayment::where("application_id","=",$id)->get();
        $fee_payment = LoanApplicationFeePayment::where("application_id","=",$application->id)->get()->first();

        return view("pages.loans.preview",[
            'fee_payment'=>$fee_payment,
            'reviews'=>$reviews,
            'payments'=>$payments,
            'application'=>$application,
            'applicant'=>Applicant::find($application->user_id),
            'loan_sub_package'=>$loan_sub_package,
            'loan_package'=>$loan_package,
        ]);
    }


    function sendLoanApplicationNotification($application){
        $user_id = $application->user_id;

        $message = "";
        switch($application->loan_status){
            case "Pending":
                $message = "Your application for the loan of ".$application->amount." is Pending";
                break;
            case "Processing":
                $message = "Your application for the loan of ".$application->amount." is being Processed";
                break;
            case "Approved":
                $message = "Your application for the loan of ".$application->amount." is being Approved, Please wait for the money";
                break;
            case "Declined":
                $message = "Your application for the loan of ".$application->amount." has been Declined";
                break;
            default :
                $message = "Your application state has changed, Please open the app to check it out";
                break;

        }

        (new NotificationsController())->sendNotificationToOnePerson("Loan Updated",$message,$user_id);

    }

}
