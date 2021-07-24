<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DB;

class EventController extends Controller
{
    public function events () {
        $events = DB::table('events')->get();
        return view('pages/events', compact('events'));
    }

    public function create_event () {
        DB::table('events')->insert([
            'title' => request('title'),
            'start_date' => request('start_date'),
            'start_time' => request('start_time'),
            'end_date' => request('end_date'),
            'end_time' => request('end_time'),
            'attendance_fee' => request('attendance_fee'),
            'location' => request('location'),
            'about' => request('about'),
            'picture' => request('picture'),
        ]);
        return redirect()->route('/events');
    }

    public function edit_event($id)
    {
        $event = DB::table('events')->where('id', $id)->first();
        return view('pages/new_event', compact('event'));
    }


    public function update_event (Request $request, $id)
    {
        DB::table('events')
            ->where('id', $id)
            ->update([
                'title' => $request->title,
                'start_date' => $request->start_date,
                'start_time' => $request->start_time,
                'end_date' => $request->end_date,
                'end_time' => $request->end_time,
                'attendance_fee' => $request->attendance_fee,
                'location' => $request->location,
                'about' => $request->about,
                'picture' => $request->picture
            ]);
        
        return redirect()->route('/events');
    }

    public function delete_event ($id){
        DB::table('events')->delete($id);
        return redirect()->route('/events');
    }

}
