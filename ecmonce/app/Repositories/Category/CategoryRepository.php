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
    public function getCategoryLibrary($type_category)
    {
        $category = $this->model->where('type_category', config('setting.mutil-level.one'))->pluck('name', 'id')->all();

        return $category;
    }

    /**
    * function getSubCategory.
     *
     * @param $parent_id
     * @return imageName
     */
    public function getSubCategory($parent_id)
    {
        $subCategory = $this->model->where('parent_id', $parent_id)->pluck('name', 'id')->all();

        return $subCategory;
    }
}
