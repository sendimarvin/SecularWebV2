<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\LoanApplication;
use App\Models\LoanApplicationFeePayment;
use App\Models\LoanPackage;
use App\Models\LoanPayment;
use App\Models\LoanSubPackage;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;
use \DB;

class PaymentController extends Controller
{

    public function applicationFeesEditSubmit(Request $request, $id){
        $status = $request->input("status");

        $fees = LoanApplicationFeePayment::find($id);

        $payment = Payment::find($fees->payment_id);
        $payment->status = $status;
        $payment->save();

        $application = LoanApplication::find($fees->application_id);

        (new NotificationsController())->sendNotificationToOnePerson("Loan Application Fees Updated","Your Loan Payment fees have been {$status}",$application->user_id);

        return redirect("payments/application_fees");

    }
    public function applicationFeesEdit($id){

        $fees = LoanApplicationFeePayment::find($id);
        $fees->payment = Payment::find($fees->payment_id);
        $application = LoanApplication::find($fees->application_id);

        $loan_sub_package = LoanSubPackage::find($application->subpackage_id);
        $loan_package = LoanPackage::find($loan_sub_package->loan_package_id);

        $applicant = Applicant::find($application->user_id);

        return view("pages.loan_application_fees.edit",[
            "fees"=>$fees,
            "applicant"=>$applicant,
            "loan_package"=>$loan_package,
            "loan_sub_package"=>$loan_sub_package,
            "application"=>$application,
        ]);

    }

    public function indexSubscription () {
        $feesPayments = Subscription::all()->map(function ($feesPayment){
            $feesPayment->payment = Payment::find($feesPayment->payment_id);
            $feesPayment->applicant = Applicant::find($feesPayment->userId);
            $feesPayment->package = SubscriptionPackage::find($feesPayment->subscriptionId);
            return $feesPayment;
        });

        return view('pages/subscription/index', ['subscriptions'=>$feesPayments]);
    }
    public function indexSubscriptionEdit($id){

        $subscription = Subscription::find($id);
        $subscription->payment = Payment::find($subscription->payment_id);
        $package = SubscriptionPackage::find($subscription->subscriptionId);
        $applicant = Applicant::find($subscription->userId);

        return view("pages/subscription/edit",[
            "subscription"=>$subscription,
            "applicant"=>$applicant,
            "package"=>$package,
        ]);

    }
    public function indexSubscriptionSubmitEdit(Request $request,$id){

        $status = $request->input("status");

        $subscription = Subscription::find($id);
        $subscription->payment_status = $status;
        $subscription->save();

        $payment = Payment::find($subscription->payment_id);
        $payment->status = $status;
        $payment->save();

        (new NotificationsController())->sendNotificationToOnePerson("Subscription Fees Updated","Your subscription fees have been {$status}",$subscription->userId);

        return redirect("subscriptions/payments");
    }




















    public function events_tickets () {
        $events_tickets = DB::table('events_tickets')
            ->select('events_tickets.id', 'events_tickets.number_of_people', 'events_tickets.status', 'events_tickets.created_at',
                'payments.title', 'payments.amount', 'payments.payment_ref', 'payments.payment_method',
                'users.firstName', 'users.lastName', 'users.middleName', 'users.phoneNumber',
                'events.start_date', 'events.start_time')
            ->join('payments', 'payments.id', '=', 'events_tickets.payment_id')
            ->join('users', 'users.id', '=', 'events_tickets.user_id')
            ->join('events', 'events.id', '=', 'events_tickets.event_id')
            ->get();
        return view('pages/events_tickets', compact('events_tickets'));
    }

    public function application_fees () {
        $feesPayments = LoanApplicationFeePayment::all()->map(function ($feesPayment){
            $feesPayment->payment = Payment::find($feesPayment->payment_id);
            $feesPayment->application = LoanApplication::find($feesPayment->application_id);

            $feesPayment->sub_package = LoanSubPackage::find($feesPayment->application->subpackage_id);
            $feesPayment->package = LoanPackage::find($feesPayment->sub_package->loan_package_id);

            $feesPayment->applicant = Applicant::find($feesPayment->application->user_id);
            return $feesPayment;
        });


        return view('pages/application_fees', ['feesPayments'=>$feesPayments]);
    }

    public function loan_payments () {
        $loan_payments = DB::table('loan_payments')
            ->select('loan_payments.id', 'loan_payments.payment_method',
                'loan_payments.payment_date', 'loan_payments.approval_status', 'loan_payments.approval_date',
                'loan_applications.application_id',
                'payments.title', 'payments.amount', 'payments.payment_ref',
                'users.firstName', 'users.lastName', 'users.middleName', 'users.phoneNumber')
            ->join('payments', 'payments.id', '=', 'loan_payments.payment_id')
            ->join('loan_applications', 'loan_applications.id', '=', 'loan_payments.application_id')
            ->join('users', 'users.id', '=', 'loan_applications.user_id')
            ->get();
        return view('pages/loan_payments', compact('loan_payments'));
    }

    public function subscriptions () {
        $subscriptions = DB::table('subscriptions')
            ->select('subscriptions.id', 'subscriptions.paymentOption', 'subscriptions.payment_date',
                'subscriptions.paymentProvider', 'subscriptions.payment_status', 'subscriptions.expiry_date',
                'subscriptionpackages.name', 'subscriptionpackages.period',
                'payments.title', 'payments.amount', 'payments.payment_ref',
                'users.firstName', 'users.lastName', 'users.middleName', 'users.phoneNumber')
            ->join('payments', 'payments.id', '=', 'subscriptions.payment_id')
            ->join('subscriptionpackages', 'subscriptionpackages.id', '=', 'subscriptions.subscriptionId')
            ->join('users', 'users.id', '=', 'subscriptions.userId')
            ->get();
        return view('pages/subscriptions', compact('subscriptions'));
    }


    public function disbursments () {
        $disbursments = DB::table('subscriptions')
            ->select('subscriptions.id', 'subscriptions.paymentOption', 'subscriptions.payment_date',
                'subscriptions.paymentProvider', 'subscriptions.payment_status', 'subscriptions.expiry_date',
                'subscriptionpackages.name', 'subscriptionpackages.period',
                'payments.title', 'payments.amount', 'payments.payment_ref',
                'users.firstName', 'users.lastName', 'users.middleName', 'users.phoneNumber')
            ->join('payments', 'payments.id', '=', 'subscriptions.payment_id')
            ->join('subscriptionpackages', 'subscriptionpackages.id', '=', 'subscriptions.subscriptionId')
            ->join('users', 'users.id', '=', 'subscriptions.userId')
            ->get();
        return view('pages/disbursments', compact('disbursments'));
    }

}
