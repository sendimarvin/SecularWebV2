<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        DB::table('admins')->insert([
            'username' => request('username'),
            'fullName' => request('fullName'),
            'email' => request('email'),
            'password' => request('password')
        ]);
        // return Redirect::route('/admins');
        return redirect()->route('admins');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = DB::table('admins')->where('id', $id)->first();
        return view('pages/create_admin', compact('admin'));
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
}
