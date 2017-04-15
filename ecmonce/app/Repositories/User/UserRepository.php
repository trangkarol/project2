<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use App\Repositories\User\UserInterface;
use Auth;

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
    * function login.
     *
     * @return $result
     */
    public function login($request)
    {
        try {
            $user = $request->only('email', 'password');

            if (Auth::attempt($user)) {
                $role = config('setting.role.user');
                if (Auth::user()->isAdmin()) {
                    $role = config('setting.role.admin');
                }

                $result = [
                    'result' => true,
                    'role' => $role,
                ];
                return $result;
            }

            return ['result' => false];
        } catch (\Exception $e) {
            return ['result' => false];
        }
    }

    /**
    * function logout.
     *
     * @return $result
     */
    public function logout($request)
    {
        try {
            Auth::guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();

            return true;
        } catch (\Exception $e) {
            return true;
        }
    }

    /**
    * function change password.
     *
     * @return $result
     */
    public function changePassword($request)
    {
        try {
            $user = $this->model->find(Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->save();
            Auth::logout();
            return true;

            $request->session()->flash('success', trans('user.msg.change-password-success'));

            return redirect()->action('Auth\LoginController@login');
        } catch(\Exception $e) {
            return false;
            $request->session()->flash('fail', trans('user.msg.change-password-fail'));
            DB::rollback();

            return redirect()->back();
        }
    }
}
