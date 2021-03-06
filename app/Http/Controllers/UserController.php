<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\LoanApplication;
use App\Models\LoanPackage;
use App\Models\LoanSubPackage;
use Illuminate\Http\Request;
use DB;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->get();
        return view('pages/users', compact('users'));
    }

    public function admins()
    {
        $admins = DB::table('admins')->get();
        return view('pages/admins', compact('admins'));
    }

    public function create_admin()
    {
        $roles = DB::table('roles')->get();
        return view('pages/create_admin', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'fullName' => 'required',
            'role' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $passwordHash =  Hash::make(request('password'));
        // dd($passwordHash);
        DB::table('admins')->insert([
            'username' => request('username'),
            'fullName' => request('fullName'),
            'role' => request('role'),
            'email' => request('email'),
            'password' => $passwordHash
        ]);
        // return Redirect::route('/admins');
        return redirect()->route('admins');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = DB::table('roles')->get();
        $admin = DB::table('admins')->where('id', $id)->first();
        return view('pages/create_admin', compact('admin', 'roles'));
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
        if ($request->password) {
            DB::table('admins')
            ->where('id', $id)
            ->update([
                'username' => $request->username,
                'fullName' => $request->fullName,
                'email' => $request->email,
                'password' => $request->password,
              ]);
        } else {
            DB::table('admins')
            ->where('id', $id)
            ->update([
                'username' => $request->username,
                'fullName' => $request->fullName,
                'email' => $request->email,
              ]);
        }

        return redirect()->route('admins');
    }

    public function approveUser(Request $request, $id)
    {
        $status = $request->input("status");

        $applicant = Applicant::find($id);
        $applicant->status = $status;
        $applicant->save();

        //send notification to user for what has happened

        if($applicant!=null  && $applicant->playerId!=""){
            $title = "";
            $content = "";

            if($status == "pending"){
                $title = "Account Is Pending";
                $content = "Please wait until your account has been verified";
            }else if($status == "approved"){
                $title = "Account is Approved";
                $content = "You can now go ahead and request a loan";
            }else if($status == "declined"){
                $title = "Account is Declined";
                $content = "Please check your information";
            }

            (new OneSignalController())->sendOneSignalNotificationToOne($title,$content,$applicant->playerId);
        }

        return redirect("/users/{$id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('admins')->delete($id);
        return redirect()->route('admins');
    }

    public function viewUser($id){

        $images_url = env("IMAGES_URL");
        $applicant=Applicant::find($id);


        return view("pages.users.preview",[
            "images_url"=>$images_url,
            "applicant"=>$applicant,
            "applications"=> LoanApplication::where("user_id","=",$applicant->id)
                ->get()
                ->map(function ($application){
                    $application->user = Applicant::find($application->user_id);
                    $application->loan_sub_package = LoanSubPackage::find($application->subpackage_id);
                    $application->loan_package = LoanPackage::find($application->loan_sub_package->loan_package_id);
                    return $application;
                })
        ]);
    }
}
