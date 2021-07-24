<?php

namespace App\Http\Controllers;

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

}
