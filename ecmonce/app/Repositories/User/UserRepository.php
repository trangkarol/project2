<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use App\Repositories\User\UserInterface;
use Auth;
use DateTime;

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
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
    * function createSocialite($user, $provider)
     *
     * @return $result
     */
    public function createSocialite($user, $provider)
    {
        try {
            $user = $this->model->find(Auth::user()->id);
            $authUser = $this->model->where('provider_id', $user->id)->first();
            if ($authUser) {
                return $authUser;
            }

            return parent::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id,
                'avatar' => config('setting.images.avatar'),
                'role' => config('setting.role.user'),
            ]);
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
    * function register
     *
     * @return $result
     */
    public function register($request, $role)
    {
        try {
            $input = $request->only(['name', 'email', 'password', 'address', 'phone_number']);
            $input['avatar'] = isset($request->file) ? $this->uploadAvatar(null, $request->file) : config('setting.images.avatar');
            $input['birthday'] = date_create($request->birthday);
            $input['role'] = $role;

            return parent::create($input);
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
    * function uploadImages.
     *
     * @return imageName
     */
    public function uploadAvatar($images = null, $fileImages = null)
    {
        if ($images != config('settings.images.avatar')) {
            unlink(config('setting.path.file') . $images);
        }

        $dt = new DateTime();
        $arr_images = explode('.', $fileImages->getClientOriginalName());
        $imageName = 'user_' . $dt->format('Y-m-d-H-i-s') . '.' .  $arr_images[count($arr_images) - 1];
        $fileImages->move(config('setting.path.file'), $imageName);

        return $imageName;
    }
}
