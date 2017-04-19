<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Category\CategoryInterface;
use App\Http\Controllers\Controller;
use Session;

class ProductController extends Controller
{
    protected $categoryRepository;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CategoryInterface $categoryRepository,
        ProductInterface $productRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.product.product_detail', compact());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findProduct($id);
        $relatedProducts = $this->productRepository->relatedProduct($product->category_id, $product->id);

        //handel viewed products
        $viewedProduct = [
            'productId' => $id,
            'dateView' => date("Y-m-d H:i:s"),
        ];

        if (Session::has('viewedProducts')) {
            $viewedProducts = Session::get('viewedProducts');
            $productIds = array_pluck($viewedProducts, 'productId');

            if (in_array($id, $productIds)) {
                $viewedProducts = array_except($viewedProducts, $id);
            }

            $viewedProducts[] = $viewedProduct;
            Session::put('viewedProducts', $viewedProducts);
        } else {
            Session::push('viewedProducts', $viewedProduct);
        }

        return view('member.product.product_detail', compact('product', 'relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
