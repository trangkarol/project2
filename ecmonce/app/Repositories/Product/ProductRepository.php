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
        // dd($oldImage);
        if ($oldImage != config('settings.images.product')) {
            unlink(config('setting.path.file') . $oldImage);
        }

        $dt = new DateTime();
        $arr_images = explode('.', $fileImages->getClientOriginalName());
        $imageName = 'product_' . $dt->format('Y-m-d-H-i-s') . '.' .  $arr_images[count($arr_images) - 1];
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
            $input = $request->only(['name', 'made_in', 'number_current', 'description', 'price']);
            $input['date_manufacture'] = date_create($request->date_manufacture);
            $input['date_expiration'] = date_create($request->date_expiration);
            $input['category_id'] = $request->subCategory;
            $input['image'] = isset($request->file) ? $this->uploadImages(null, $request->file) : config('settings.images.product');
            $result = parent::create($input);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
    * function create.
     *
     * @return true or false
     */
    public function update($request, $id)
    {
        try {
            $product = parent::find($id, 'image');
            $input = $request->only(['name', 'made_in', 'number_current', 'description']);
            $input['date_manufacture'] = date_create($request->date_manufacture);
            $input['date_expiration'] = date_create($request->date_expiration);
            $input['category_id'] = $request->subCategory;
            if (isset($request->file)) {
                $input['image'] = $this->uploadImages($product->image, $request->file);
            }

            parent::update($input, $id);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
    * function findProduct.
     *
     * @return true or false
     */
    public function findProduct($productId)
    {
        $product = $this->model->with('category')->where('id', $productId)->first();
        return $product;
    }
}
