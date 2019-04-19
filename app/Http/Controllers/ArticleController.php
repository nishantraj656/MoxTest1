<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data=Article::all();

return view('Page.articles',['data' => $data]);
    }

    public function view(){
         /**SELECT `articleID`, `Articles`, `created_at`, `updated_at` FROM `articles` WHERE 1 */
       $data = DB::table('articles')
       ->select('articleID as id', 'Articles as data')
       ->get();

       return $data;
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
    // public function store(Request $request)
    // {
    //     $id = $request->id;
    //     $request->validate([
    //        'data' => 'required',
    //        ]);
    //    if($id != null || $id !='')
    //         $this->updateV($request);
    //     else

    //    $data = Article::create( [
    //         'Articles'=>$request->data
    //     ]);
    
      
    //   return $id;
    // }

    public function stores(Request $request)
    {
        $id = $request->id;
        $request->validate([
           'data' => 'required',
           ]);
       if($id != null || $id !='')
            $this->updateV($request);
        else
       $data = Article::create( [
            'Articles'=>$request->data
        ]);

      
      return "true";
    }

   

    /**
     * Show the form for editing the specified resource.
    
     */
    public function edit($id)
    {
      $data =DB::table('articles')
      ->select('articleID as id', 'Articles as data')
      ->where('articleID',$id)
      ->get(); 
        

       return $data;
      
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
   
     */
   

    public function updateV(Request $request)
    {
        $id= $request->id;
        $request->validate([
            'data' => 'required',
            ]);
        
            Article::where('articleID',$id)
        ->update( [
             'Articles'=>$request->data
         ]);
 
         
       
       return "Done";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
    
     */
    public function destroy($id)
    {
        Article::where('articleID',$id)->delete();
        return "done"; 
    }

    public function remove($id)
    {
       Article::where('articleID',$id)->delete();
        return  "done";
    }
}
