<?php

namespace App\Repositories\User;

use Auth;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use Exception;
use File;
use App\Repositories\User\UserInterface;

class UserRepository extends BaseRepository implements UserInterface
{
    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
    * function uploadImages.
     *
     * @return imageName
     */
    public function login($request)
    {
        try {
            $user = $request->only('email', 'password');

            if (Auth::attempt($user)) {
                $request->session()->flash('success', trans('user.msg.login-success'));

                if (Auth::user()->isAdmin()) {
                    $this->activity->insertActivities(Auth::user(), 'login');
                    $role = config('setting.role.user');
                    return redirect()->action('Admin\UserController@index');
                }

                $this->activity->insertActivities(Auth::user(), 'login');
                $role = config('setting.role.admin');
                $result = [
                    'result' => true,
                    'role' => $role,
                ];
                return $result;

                return redirect()->action('Member\HomeController@index');
            }

            $request->session()->flash('fail', trans('user.msg.login-fail'));
            return redirect()->action('Auth\LoginController@index');
        } catch (\Exception $e) {
            $result = [
                'result' => false,
            ];
        }
    }
}
