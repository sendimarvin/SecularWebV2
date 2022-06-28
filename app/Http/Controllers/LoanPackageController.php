<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DB;

class LoanPackageController extends Controller
{
    public function loanPackages () {
        $loan_packages = DB::table('loan_packages')->get();
        return view('pages/loan_packages', compact('loan_packages'));
    }

    public function create_package () {
        DB::table('loan_packages')->insert([
            'loan' => request('loan'),
            'content' => base64_encode(request("content")),
        ]);
        return redirect()->route('/loans/packages');
    }

    public function edit_package($id)
    {
        $loanpackage = DB::table('loan_packages')->where('id', $id)->first();
        return view('pages/new_loan_package', compact('loanpackage'));
    }


    public function update_package (Request $request, $id)
    {
        DB::table('loan_packages')
            ->where('id', $id)
            ->update([
                'loan' => $request->loan,
                'content' => base64_encode($request->input("content")),
            ]);

        return redirect()->route('/loans/packages');
    }

    public function delete_package ($id){
        DB::table('loan_packages')->delete($id);
        return redirect()->route('/loans/packages');
    }




    ///////////////////////////////////
    public function sub_packages () {
        $sub_packages = DB::table('loan_sub_packages')
            ->select('loan_sub_packages.id', 'loan_packages.loan', 'loan_sub_packages.sub_loan', 'max_amount',
                'interest', 'max_period','loan_sub_packages.content')
            ->join('loan_packages', 'loan_packages.id', '=', 'loan_sub_packages.loan_package_id')
            ->get();
        return view('pages/loan_sub_packages', compact('sub_packages'));
    }

    public function create_sub_package () {
        DB::table('loan_sub_packages')->insert([
            'sub_loan' => request('sub_loan'),
            'max_amount' => request('max_amount'),
            'interest' => request('interest'),
            'loan_package_id' => request('loan_package_id'),
            'max_period' => request('max_period'),
            'content' => base64_encode(request("content")),
        ]);
        return redirect()->route('/loans/sub_packages');
    }

    public function edit_sub_package($id)
    {
        $loan_packages = DB::table('loan_packages')->get();
        $sub_package = DB::table('loan_sub_packages')->where('id', $id)->first();
        return view('pages/new_loan_sub_package', compact('sub_package', 'loan_packages'));
    }

    public function new_sub_package()
    {
        $loan_packages = DB::table('loan_packages')->get();
        return view('pages/new_loan_sub_package', compact('loan_packages'));
    }


    public function update_sub_package (Request $request, $id)
    {
        DB::table('loan_sub_packages')
            ->where('id', $id)
            ->update([
                'sub_loan' => $request->sub_loan,
                'max_amount' => $request->max_amount,
                'interest' => $request->interest,
                'loan_package_id' => $request->loan_package_id,
                'max_period' => $request->max_period,
                'content' => base64_encode($request->input("content")),
            ]);

        return redirect()->route('/loans/sub_packages');
    }

    public function delete_sub_package ($id){
        DB::table('loan_sub_packages')->delete($id);
        return redirect()->route('/loans/sub_packages');
    }

}
