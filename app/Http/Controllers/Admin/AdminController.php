<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /* public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    } */
    public function showLoginForm()
    {
        return view('admin.login');
    }
    public function guard()
    {
        return Auth::guard('admin');
    }
    public function loginAdmin(Request $request)
    {

        $data = $request->only('email', 'password');
        if (Auth::guard('admin')/*->attempt($data)*/) {
            return redirect()->route('admin.users');
        } else {
            return view('admin.login');
        }
    }
}
