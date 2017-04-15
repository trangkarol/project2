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
    * function uploadImages.
     *
     * @return imageName
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
            dd($e);
            return ['result' => false];
        }
    }
}
