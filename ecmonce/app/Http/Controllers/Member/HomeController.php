<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryInterface;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $cateRepository;

    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CategoryInterface $cateRepository
    ) {
        $this->cateRepository = $cateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->cateRepository->getMenu();
        return view('member.home.home', compact('menus'));
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
     * getFormLogin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getFormLogin()
    {
        try {
            $html = view('member.user.login')->render();

            return response()->json(['result' => true, 'html' => $html]);
        } catch (\Exception $e) {
            return response()->json('result', true);
        }
    }
}