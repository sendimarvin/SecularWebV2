<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DB;

class PaymentController extends Controller
{
    
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
        $application_fees = DB::table('loan_application_fee_payments')
            ->select('loan_application_fee_payments.id', 'loan_application_fee_payments.payment_method', 
                'loan_application_fee_payments.payment_date',
                'loan_applications.application_id',
                'payments.title', 'payments.amount', 'payments.payment_ref',
                'users.firstName', 'users.lastName', 'users.middleName', 'users.phoneNumber')
            ->join('payments', 'payments.id', '=', 'loan_application_fee_payments.payment_id')
            ->join('loan_applications', 'loan_applications.id', '=', 'loan_application_fee_payments.application_id')
            ->join('users', 'users.id', '=', 'loan_applications.user_id')
            ->get();
        return view('pages/application_fees', compact('application_fees'));
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

}
