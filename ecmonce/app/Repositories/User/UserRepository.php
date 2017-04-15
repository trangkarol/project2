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
                if (Auth::user()->isAdmin()) {
                    $this->activity->insertActivities(Auth::user(), 'login');
                    $role = config('setting.role.user');
                }

                $this->activity->insertActivities(Auth::user(), 'login');
                $role = config('setting.role.admin');
                $result = [
                    'result' => true,
                    'role' => $role,
                ];
                return $result;
            }

            $result = [
                'result' => false,
            ];
        } catch (\Exception $e) {
            $result = [
                'result' => false,
            ];
        }
    }
}
