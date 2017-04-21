<?php

namespace App\Repositories\Product;

use Auth;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use DateTime;
use Session;
use DB;

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
    * function getProduct.
     *
     * @return imageName
     */
    public function getProduct()
    {
        return $this->model->with('category')->paginate(12);
    }

    /**
    * function create.
     *
     * @return true or false
     */
    public function create($request)
    {
        try {
            $input = $request->only(['name', 'made_in', 'number_current', 'description', 'price', 'date_manufacture', 'date_expiration']);
            $input['category_id'] = $request->subCategory;
            $input['image'] = isset($request->file) ? parent::uploadImages(null, $request->file, null) : config('settings.images.product');
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
    public function saveRequestProduct($products)
    {
        DB::beginTransaction();
        try {
            parent::create($products);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            return false;
        }
    }

    /**
    * function update.
     *
     * @return true or false
     */
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $product = parent::find($id, 'image');
            $input = $request->only(['name', 'made_in', 'number_current', 'description', 'date_manufacture', 'date_expiration']);
            $input['category_id'] = $request->subCategory;
            if (isset($request->file)) {
                $input['image'] = parent::uploadImages($product->image, $request->file, config('setting.images.product'));
            }

            parent::update($input, $id);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();

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
        return $this->model->with('category')->where('id', $productId)->first();
    }

    /**
    * function getProductCategory.
     *
     * @return true or false
     */
    public function getProductCategory($categoryId)
    {
        return $this->model->whereHas('category', function($query) use ($categoryId) {
            $query->where('parent_id', $categoryId);
        })->paginate(12);
    }

    /**
    * function listProduct.
     *
     * @return true or false
     */
    public function listProduct($productIds)
    {
        return $this->model->whereIn('id', $productIds)->get();
    }

    /**
    * function relatedProduct.
     *
     * @return true or false
     */
    public function relatedProduct($categoryId, $productId)
    {
        return $this->model->where('category_id', $categoryId)->where('id', '!=', $productId)->take(8)->get();
    }

    /**
    * function  hotProduct.
     *
     * @return true or false
     */
    public function hotProduct()
    {
        return $this->model->join('order_details', 'products.id', 'order_details.product_id')
            ->select(
                'products.id',
                'products.name',
                'products.image',
                'products.price',
                'products.avg_rating',
                \DB::raw('SUM(order_details.product_id) as numberProduct')
            )
            ->groupBy('products.id', 'products.name', 'products.image', 'products.price', 'products.avg_rating')
            ->orderBy('numberProduct', 'desc')->take(8)->get();
    }

    /**
    * function  new Product.
     *
     * @return true or false
     */
    public function newProduct()
    {
        return $this->model->select('products.id', 'products.name', 'products.image', 'products.price', 'products.avg_rating')
            ->where(\DB::raw('DATEDIFF(NOW(), created_at)'), '<=', 3)->orderBy('created_at', 'desc')->take(8)->get();
    }

    /**
    * function saveFile
     *
     * @return true or false
     */
    public function saveFile($products)
    {
        DB::beginTransaction();
        try {
            foreach ($products as $product) {
                $inputs = $this->dataProduct($product);
                if (!$this->validator($inputs)->validate()) {
                    parent::create($inputs);
                }
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }

    /**
    * function searchProduct($input)
     *
     * @return true or false
     */
    public function searchProduct($input)
    {
        try {
            $products = $this->model;
            if ($input['categoryId'] != config('setting.search_default')) {
                $categoryId = $input['categoryId'];
                $products = $products->with(['category' => function ($query) use ($categoryId) {
                    $query->where('parent_id', $input['categoryId']);
                }]);
            }

            if ($input['rating']!= config('setting.search_default')) {
                $products = $products->where('avg_rating', '>=', $input['rating']);
            }

            if ($input['price_from'] != config('setting.search_default')) {
                $products = $products->where('price', '>=', $input['price_from']);
            }

            if ($input['price_to'] != config('setting.search_default')) {
                $products = $products->where('price', '<=', $input['price_to']);
            }

            if (!empty($input['name'])) {
                $products = $products->where('name', 'LIKE', '%' . $input['name']);
            }

            if ($input['sort_price'] == 1) {
                $products = $products->orderBy('price', 'asc');
            }

            if ($input['sort_price'] == 2) {
                $products = $products->orderBy('price', 'desc');
            }

            return $products->paginate(12);
        } catch (\Exception $e) {
            dd($e);
            return false;
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:50|min:4|unique:products',
            'date_manufacture' => 'required',
            'date_expiration' => 'required|after:date_manufacture',
            'description' => 'required|min:30',
            'price' => 'required',
            'number' => 'required',
        ]);
    }
}
