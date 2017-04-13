<?php

namespace App\Repositories\Product;

use Auth;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use Exception;
use File;

class ProductRepository extends BaseRepository implements ProductInterface
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function create($request)
    {
        $input = $request->only(['name', 'price', 'made_in', 'number', 'date_manufacture', 'date_expiration', 'category_id']);
        $input['images'] = isset($request->images)
            ? $this->uploadAvatar()
            : config('settings.images.avatar');
        return $this->model->create($input);
    }

    public function update($request)
    {
        $fileName = isset($request['avatar'])
            ? $this->uploadAvatar()
            : config('settings.user.avatar_default');
        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
            'avatar' => $fileName,
            'password' => $request['password'],
        ];
        return $this->model->create($input);
    }

    protected function uploadImages($oldImage = null)
    {
        $dt = new DateTime();
        $arr_images = explode('.', $fileImages->getClientOriginalName());
        $imageName = 'users_' . $dt->format('Y-m-d-H-i-s') . '.' .  $arr_images[count($arr_images) - 1];
        $fileImages->move(config('setting.path.file'), $imageName );

         return $imageName;
    }
}
