<?php

namespace App\Repositories\SuggestProduct;

interface SuggestProductInterface
{
    public function create($input);

    public function getSuggestProduct();

    public function updateSuggestProduct($input, $file, $id);
}
