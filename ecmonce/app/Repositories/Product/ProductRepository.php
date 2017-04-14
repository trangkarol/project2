<?php

namespace App\Repositories\Product;

use Auth;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use DateTime;

class ProductRepository extends BaseRepository implements ProductInterface
{
    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
    * function uploadImages.
     *
     * @return imageName
     */
    public function uploadImages($oldImage = null, $fileImages = null)
    {
        if ($oldImage != config('settings.images.avatar')) {
            unlink(config('setting.path.file') . $oldImage);
        }

        $dt = new DateTime();
        $arr_images = explode('.', $fileImages->getClientOriginalName());
        $imageName = 'users_' . $dt->format('Y-m-d-H-i-s') . '.' .  $arr_images[count($arr_images) - 1];
        $fileImages->move(config('setting.path.file'), $imageName);

        return $imageName;
    }

    /**
    * function getProduct.
     *
     * @return imageName
     */
    public function getProduct()
    {
        $products = $this->model->with('category')->paginate(15);

        return $products;
    }

    /**
    * function create.
     *
     * @return true or false
     */
    public function create($request)
    {
        try {
            $input = $request->only(['name', 'made_in', 'number_current', 'description']);
            $input['price'] = '100.000';
            $input['date_manufacture'] = date_create($request->date_manufacture);
            $input['date_expiration'] = date_create($request->date_expiration);
            $input['category_id'] = $request->category;
            $input['image'] = isset($request->file) ? $this->uploadImages(null, $request->file) : config('settings.images.product');
            $input['avg_rating'] = '1.4';
            parent::create($input);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
