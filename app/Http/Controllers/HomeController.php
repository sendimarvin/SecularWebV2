<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\KadaamaApplication;
use App\Models\LoanApplication;
use App\Models\LoanApplicationFeePayment;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showDashboard(){


        if(Auth::check()){
            return view('pages/dashboard',[
                "easypay_balance"=>json_decode((new EasyPayHelper())->checkbalance()),
                "loan_application_pending"=>LoanApplication::where("loan_status","=","pending")->count(),
                "loan_application_declined"=>LoanApplication::where("loan_status","=","declined")->count(),
                "loan_application_processing"=>LoanApplication::where("loan_status","=","processing")->count(),
                "loan_application_approved"=>LoanApplication::where("loan_status","=","approved")->count(),

                "loan_application_all"=>LoanApplication::count(),
                "kadaama_applications"=>KadaamaApplication::count(),
                "applicants"=>Applicant::count(),
                "administrators"=>User::count(),

                "events_fees"=>DB::table("events_tickets")
                    ->join('payments', 'payments.id', '=', 'events_tickets.payment_id')
                    ->select('payments.amount')
                    ->sum("amount"),

                "payments"=>Payment::orderBy("id","DESC")->limit(15)->get(),
                "subscription_fees"=>Subscription::where("amount","!=","")->sum("amount"),
                "loan_application_fees"=>LoanApplicationFeePayment::where("amount","!=","")->sum("amount"),


                "loan_application_disbursed"=>LoanApplication::where("loan_status","=","disbursed")->count(),
                "loan_amount_disbursed"=>LoanApplication::where("loan_status","=","disbursed")
                    ->orWhere("loan_status","=","paid")
                    ->sum("amount"),

                "loan_application_paid"=>LoanApplication::where("loan_status","=","paid")->count(),
            ]);
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
