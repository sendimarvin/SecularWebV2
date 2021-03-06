<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class SettingController extends Controller
{

    public function terms() {
        $settings = DB::table('settings')->first();
        return view('pages/terms', compact('settings'));
    }


    public function update_terms (Request $request, $id) {
        DB::table('settings')
        ->where('id', $id)
        ->update([
            'terms' => base64_encode($request->terms)
            ]);
    
        return redirect()->route('/terms');
    }

    public function policy() {
        $settings = DB::table('settings')->first();
        return view('pages/policy', compact('settings'));
    }

    public function kadama_terms() {
        $settings = DB::table('settings')->first();
        return view('pages/kadama_terms', compact('settings'));
    }


    public function update_kadama_terms (Request $request, $id) {
        DB::table('settings')
        ->where('id', $id)
        ->update([
            'kadama_terms' => base64_encode($request->kadama_terms)
            ]);
    
        return redirect()->route('/kadama_terms');
    }

    public function update_policy (Request $request, $id) {
        DB::table('settings')
        ->where('id', $id)
        ->update([
            'policy' => base64_encode($request->policy)
            ]);
    
        return redirect()->route('/policy');
    }


    public function application_fee() {
        $settings = DB::table('settings')->first();
        return view('pages/application_fee', compact('settings'));
    }


    public function update_application_fee (Request $request, $id) {
        DB::table('settings')
        ->where('id', $id)
        ->update([
            'application_fee' => $request->application_fee
            ]);
    
        return redirect()->route('/application_fee');
    }


    public function payments_setup() {
        $settings = DB::table('settings')->first();
        return view('pages/payments_setup', compact('settings'));
    }


    public function update_payments_setup (Request $request, $id) {
        DB::table('settings')
        ->where('id', $id)
        ->update([
            'payment_url' => $request->payment_url,
            'payment_username' => $request->payment_username,
            'payment_password' => $request->payment_password
            ]);
    
        return redirect()->route('/payments_setup');
    }

}
