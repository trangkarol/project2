<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\User\UserInterface;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\User\InsertUserRequest;
use DB;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
    }

    /**
     * get form register.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function index()
    {
        return view('member.user.register');
    }

    /**
     * register a member.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function register(InsertUserRequest $request)
    {
        DB::beginTransaction();
        $result = $this->userRepository->register($request, config('setting.role.user'));
        if ($result) {
            DB::commit();
            Auth::login($result, true);

            return redirect()->action('Member\HomeController@index');
        }

        DB::rollback();

        return redirect()->action('Member\HomeController@index');
    }
}
