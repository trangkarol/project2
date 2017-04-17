<?php

namespace App\Repositories\SuggestProduct;

use Auth;
use App\Models\SuggestProduct;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use DateTime;
use DB;

class SuggestProductRepository extends BaseRepository implements SuggestProductInterface
{
    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SuggestProduct $suggestProduct)
    {
        $this->model = $suggestProduct;
    }

    /**
    * function create.
     *
     * @return true or false
     */
    public function create($input)
    {
        DB::beginTransaction();
        try {
            $result = parent::create($input);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }

    /**
    * function updateSuggestProduct.
     *
     * @return true or false
     */
    public function updateSuggestProduct($input, $file, $id)
    {
        DB::beginTransaction();
        try {
            $suggestProduct = $this->model->find($id);
            if (!is_null($file)) {
                $tnput['images'] = isset($request->file) ? parent::uploadImages($suggestProduct->images, $file, config('settings.images.product')) : $suggestProduct->images;
            }

            $result = parent::create($input);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }

    /**
    * function getSuggestProduct.
     *
     * @return true or false
     */
    public function getSuggestProduct()
    {
        return $this->model->paginate(config('setting.admin.paginate'));
    }
}
