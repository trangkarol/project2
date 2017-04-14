<?php

namespace App\Http\Controllers\Admin;

    use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductInterface;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\Product\InsertProductRequest;
use App\Helpers\Library;
    use DB;

class ProductController extends Controller
{

    protected $productRepository;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
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
        $categoryOne = Library::getCategoryLevel(config('setting.mutil-level.one'));

        return view('admin.product.create', compact('categoryOne'));
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
            $this->productRepository->create($request);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);
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
