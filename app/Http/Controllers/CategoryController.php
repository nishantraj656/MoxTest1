<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessionDataArray=array();
        if (Session::has('cat')) {
            $sessionDataArray = Session::get('cat');
        }

        // var_dump($sessionDataArray);
        return view('Page.categories',["datas"=>$sessionDataArray]);
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
        $data = $request->categorie;
        $sessionDataArray=array();
        if ($request->session()->has('cat')) {
            $sessionDataArray = $request->session()->get('cat');
        }

        array_push($sessionDataArray,$request->categorie);
         $request->session()->put('cat',$sessionDataArray);

         $request->session()->flash('status', 'Data Add!');
         return Redirect('/categories');
    }

    public function save(Request $request)
    {
        $sessionDataArray=array();
        if ($request->session()->has('cat')) {
            $sessionDataArray = $request->session()->get('cat');
        }

        foreach($sessionDataArray as $value)
        {
          
          Category::create( [
            'categorie'=>$value
        ]);

        }

        $request->session()->flash('status', 'Data Save...!');
        $request->session()->forget('cat');
        return Redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
