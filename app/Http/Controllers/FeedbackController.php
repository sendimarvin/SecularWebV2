<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DB;

class FeedbackController extends Controller
{
    

    public function feedback () {
        $feedbacks = DB::table('feedback')
            ->select('feedback.id', 'feedback.rating', 'feedback.rating_title', 'feedback.comment',
                'feedback.created_at', 'users.firstName', 'users.lastName', 'users.middleName', 'users.phoneNumber')
            ->join('users', 'users.id', '=', 'feedback.user_id')
            ->get();
        return view('pages/feedback', compact('feedbacks'));
    }
}
