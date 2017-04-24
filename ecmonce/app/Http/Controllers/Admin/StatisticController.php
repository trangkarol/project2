<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ReportController as Report;
use App\Repositories\OrderDetail\OrderDetailInterface;
use DateTime;

class StatisticController extends Controller
{
    protected $orderDetailRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderDetailInterface $orderDetailRepository)
    {
        $this->orderDetailRepository = $orderDetailRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statisticCategory = $this->orderDetailRepository->statistiCategory();
        $totalPrice = $statisticCategory->pluck('totalPrice')->all();
        $nameCategory = $statisticCategory->pluck('parentNameCategory')->all();

        return view('admin.statistic.index', compact('statisticCategory', 'totalPrice', 'nameCategory'));
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

    /**
     * export file statistic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exportFile()
    {
        try {
            $dateTime = new DateTime;
            $products =$this->orderDetailRepository->statisticProduct();
            $nameFile = 'products_'.$dateTime->format('Y-m-d-H-i-s');
            Report::exportFileExcel($products, 'xls', $nameFile, 'admin.statistic.export_statistic');
            $request->session()->flash('success', trans('user.msg.import-success'));

            return redirect()->action('Admin\StatisticController@index');
        } catch (\Exception $e) {
            dd($e);
            return response()->json('result', false);
        }
    }
}
