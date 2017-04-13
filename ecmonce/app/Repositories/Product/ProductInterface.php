<?php

namespace App\Repositories\Product;

interface ProductInterface
{
    public function create($request);

    public function update($request);

    public function uploadImages($file);
}
