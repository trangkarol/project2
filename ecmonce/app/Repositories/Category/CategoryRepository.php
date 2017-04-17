<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
    * function getCategoryLibrary.
     *
     * @return imageName
     */
    public function getCategoryLibrary($type_category, $array = ['*'])
    {
        return $this->model->where('type_category', config('setting.mutil-level.one'))->pluck('name', 'id')->all();
    }

    /**
    * function getSubCategory.
     *
     * @param $parent_id
     * @return imageName
     */
    public function getSubCategory($parent_id)
    {
        return $this->model->where('parent_id', $parent_id)->pluck('name', 'id')->all();
    }

    /**
    * function get memnu.
     *
     * @param $parent_id
     * @return imageName
     */
    public function getMenu()
    {
        return $this->model->with('subCategory')->get();
    }

    /**
    * function getProductHome.
     *
     * @return true or false
     */
    public function getProductHome()
    {
        return $this->model->with('subCategory.products')->get();
    }

    /**
    * function productCategory.
     *
     * @return true or false
     */
    public function productCategory()
    {
        return $this->model->with('products')->where('type_category', config('setting.mutil-level.one'))->paginate(config('setting.user.paginate'));
    }
}
