<?php

namespace App\Repositories\Category;

interface CategoryInterface
{
    public function getCategoryLibrary($type_category);

    public function getSubCategory($parent_id);

    public function getMenu();
}
