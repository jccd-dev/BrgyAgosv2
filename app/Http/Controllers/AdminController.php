<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('adminl-login');
    }

    public function renderSetting(){
        return view('dashboard.setting');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|alpha_num',
            'password' => 'required'
        ]);

        // dd(Hash::make($credentials['password']));
        // $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['success' => 'logged in'], 200);
        }

        return response()->json(['errors' => 'The provided credentials do not match our records.'], 420);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $credentials = $request->validate([
            'username'      => 'required|alpha_num',
            'oldpassword'   => 'required',
            'newpass'       => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        ]);

        $admin_user = Admin::find(Auth::user()->id);
        if(!Hash::check($credentials['oldpassword'], $admin_user->password)) {
            return response()->json(['errors' => ['oldpassword' => 'Old Password Not match']], 420);
        }

        $admin_user->username = $credentials['username'];
        $admin_user->password = Hash::make($credentials['newpass']);

        if(!$admin_user->save()){
            return response()->json(['errors' => 'Try again later'], 420);
        }

        return response()->json(['success' => 'Admin Credentials Updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
