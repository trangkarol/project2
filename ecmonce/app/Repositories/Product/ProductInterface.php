<?php

namespace App\Repositories\Product;

interface ProductInterface
{
    public function create($request);

    public function getProduct();

    public function findProduct($productId);

    public function uploadImages($file);

    public function hotProduct();

    public function newProduct();
}
