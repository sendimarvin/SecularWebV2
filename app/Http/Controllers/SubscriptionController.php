<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DB;

class SubscriptionController extends Controller
{
    public function subscription_packages () {
        $subscriptionpackages = DB::table('subscriptionpackages')->get();
        return view('pages/subscription_packages', compact('subscriptionpackages'));
    }

    public function create_subscription_package () {
        DB::table('subscriptionpackages')->insert([
            'name' => request('name'),
            'amount' => request('amount'),
            'benefits' => request('benefits'),
            'period' => request('period'),
        ]);
        return redirect()->route('/subscription/subscription_packages');
    }

    public function edit_subscription_package($id)
    {
        $subscriptionpackage = DB::table('subscriptionpackages')->where('id', $id)->first();
        return view('pages/new_subscription_package', compact('subscriptionpackage'));
    }


    public function update_subscription_package (Request $request, $id)
    {
        DB::table('subscriptionpackages')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'amount' => $request->amount,
                'benefits' => $request->benefits,
                'period' => $request->period,
            ]);
        
        return redirect()->route('/subscription/subscription_packages');
    }

    public function delete_subscription_package($id){
        DB::table('subscriptionpackages')->delete($id);
        return redirect()->route('/subscription/subscription_packages');
    }


}
