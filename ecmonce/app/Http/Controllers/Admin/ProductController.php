<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Category\CategoryInterface;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\Product\InsertProductRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ReportController as Report;
use App\Helpers\Library;
use DB;

class ProductController extends Controller
{

    protected $productRepository;
    protected $categoryRepository;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductInterface $productRepository,
        CategoryInterface $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->getProduct();

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */
    public function create()
    {
        $parentCategory = $this->categoryRepository->getCategoryLibrary(config('setting.mutil-level.one'));
        $madeIn = Library::getMadeIn();

        return view('admin.product.create', compact('parentCategory', 'subCategory', 'madeIn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsertProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $ressult = $this->productRepository->create($request);
            if (!$ressult) {
                $request->session()->flash('fail', trans('product.msg.insert-fail'));
                DB::rollback();

                return redirect()->back();
            }

            DB::commit();
            $request->session()->flash('success', trans('product.msg.insert-success'));

            return redirect()->action('Admin\ProductController@index');
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('fail', trans('product.msg.insert-fail'));

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->findProduct($id);
        $parentCategory = $this->categoryRepository->getCategoryLibrary(config('setting.mutil-level.one'));
        $madeIn = Library::getMadeIn();

        return view('admin.product.edit', compact('product', 'parentCategory', 'madeIn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $ressult = $this->productRepository->update($request, $id);
            if (!$ressult) {
                $request->session()->flash('fail', trans('product.msg.update-fail'));
                DB::rollback();

                return redirect()->back();
            }

            DB::commit();
            $request->session()->flash('success', trans('product.msg.update-success'));

            return redirect()->action(['Admin\ProductController@edit', $id]);
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('fail', trans('product.msg.update-fail'));

            return redirect()->back();
        }
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

    /**
     * Get sub category
     *
     * @param  int  $parent_id
     * @return \Illuminate\Http\Response
     */
    public function getSubCategory(Request $request)
    {
        $parent_id = $request->parent_id;
        $sub_id = $request->sub_id;
        try {
            $subCategory = $this->categoryRepository->getSubCategory($parent_id);
            $html = view('admin.product.sub_category', compact('subCategory', 'sub_id'))->render();

            return response()->json(['result' => true, 'html' => $html]);
        } catch (\Exception $e) {
            return response()->json('result', false);
        }
    }

    /**
     * importFile
     *
     * @param  int  $parent_id
     * @return \Illuminate\Http\Response
     */
    public function importFile(Request $request)
    {
        $file = $request->file;
        try {
            $nameFile = '';
            if (isset($file)) {
                $nameFile = $this->productRepository->importFile($file);
                $products = Report::importFileExcel($nameFile);
                // dd($products);
            }

            return view('admin.product.import_product', compact('products', 'nameFile'));
        } catch (Exception $e) {
            return redirect()->action('Admin\ProductController@index');
        }
    }

    /**
     * importFile
     *
     * @param  int  $parent_id
     * @return \Illuminate\Http\Response
     */
    public function saveImport(Request $request)
    {
        $nameFile = $request->nameFile;
        try {
            $products = Report::importFileExcel($nameFile)->toArray();
            $this->productRepository->saveFile($products);
            $request->session()->flash('success', trans('product.msg.import-success'));

            return redirect()->action('Admin\ProductController@index');
        } catch (\Exception $e) {
            $request->session()->flash('fail', trans('product.msg.import-fail'));

            return redirect()->action('Admin\ProductController@index');
        }
    }

    /**
     *data Product.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function dataProduct($product)
    {
        $data = [];
        $data['name'] = $product['name'];
        $data['image'] = config('setting.images.product');
        $data['price']= $product['price'];
        $data['number_current']= $product['number'];
        $data['made_in'] = $product['made_in'];
        $data['date_manufacture'] = $product['date_manufacture'];
        $data['date_expiration'] = $product['date_expiration'];
        $data['description'] = $product['description'];
        return $data;
    }
}
