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

}
