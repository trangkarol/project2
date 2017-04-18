<?php

namespace App\Repositories\SuggestProduct;

interface SuggestProductInterface
{
    public function create($input);

    public function delete($id);

    public function getSuggestProduct();

    public function updateSuggestProduct($input, $file, $id);
}
