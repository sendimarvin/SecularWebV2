<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Hospitals;
use App\Models\LifetimeBeneficiaries;
use App\Models\LifetimeBeneficiariesExamination;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LifetimeSubscriptionsController extends Controller
{
    //

    public function index () {
        $subscriptions = DB::table('subscriptions')
            ->select('subscriptions.id', 'subscriptions.paymentOption', 'subscriptions.payment_date',
                'subscriptions.paymentProvider', 'subscriptions.payment_status', 'subscriptions.expiry_date',
                'subscriptionpackages.name', 'subscriptionpackages.period',
                'payments.title', 'payments.amount', 'payments.payment_ref',
                'users.firstName', 'users.lastName', 'users.middleName', 'users.phoneNumber')
            ->join('payments', 'payments.id', '=', 'subscriptions.payment_id')
            ->join('subscriptionpackages', 'subscriptionpackages.id', '=', 'subscriptions.subscriptionId')
            ->join('users', 'users.id', '=', 'subscriptions.userId')
            ->where('subscriptions.subscriptionId',"=","5")
            ->get();
        return view('pages/subscription/lifetime_subscription', compact('subscriptions'));
    }

    function preview($id){
        $subscription = Subscription::find($id);
        $applicant = Applicant::find($subscription->userId);
        $payment = Payment::find($subscription->payment_id);
        $subscriptionPackage = SubscriptionPackage::find($subscription->subscriptionId);
        $lifetimeBeneficiaries = LifetimeBeneficiaries::where("subscription_id","=",$subscription->id)
                ->get()
                ->map(function ($beneficiary){
                    $beneficiary->records = LifetimeBeneficiariesExamination::where("beneficiary_id","=",$beneficiary->id)
                        ->get()
                        ->map(function ($record){
                            $record->hospital = Hospitals::find($record->hospital_id);
                            return $record;
                        });
                    return $beneficiary;
                });



        return view('pages/subscription/lifetime_subscription_preview',[
            'subscription'=>$subscription,
            'applicant'=>$applicant,
            'payment'=>$payment,
            'subscriptionPackage'=>$subscriptionPackage,
            'lifetimeBeneficiaries'=>$lifetimeBeneficiaries,
        ]);

    }

    function add_beneficiary_examination($id){

        $ben = LifetimeBeneficiaries::find($id);

        $hospitals = Hospitals::all();

        return view('pages/subscription/lifetime_beneficiary_examination_add',[
            "hospitals"=>$hospitals,
            "beneficiary"=>$ben,
        ]);
    }

    function save_beneficiary_examination($id,Request $request){

        $ben = LifetimeBeneficiaries::find($id);

        LifetimeBeneficiariesExamination::create([
           "beneficiary_id"=>$id,
           "hospital_id"=>$request->hospital_id,
           "amount"=>$request->amount,
           "year"=>$request->year,
        ]);

        return $this->preview($ben->subscription_id);
    }
}
