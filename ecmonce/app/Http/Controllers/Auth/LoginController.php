<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * login.
     *
     * @return void
     */
    public function index()
    {
        return view('admin.common.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login(LoginRequest $request)
    {

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function logout(Request $request)
    {
        $this->activity->insertActivities(Auth::user(), 'logout');
        Auth::guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->action('Auth\LoginController@index');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function changePassword(Request $request)
    {
        $this->activity->insertActivities(Auth::user(), 'logout');
        Auth::guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->action('Auth\LoginController@index');
    }
}
