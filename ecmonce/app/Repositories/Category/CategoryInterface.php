<?php

namespace App\Repositories\Category;

interface CategoryInterface
{
    /**
    * get Category Library.
     *
     * @return void
     */
    public function getCategoryLibrary($type_category);

    /**
    * getSubCategory.
     *
     * @param $parent_id
     * @return void
     */
    public function getSubCategory($parent_id);
}
