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


    public function update_policy (Request $request, $id) {
        DB::table('settings')
        ->where('id', $id)
        ->update([
            'policy' => base64_encode($request->policy)
            ]);
    
        return redirect()->route('/policy');
    }

}
