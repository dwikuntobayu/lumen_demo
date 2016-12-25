<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //this index and can query via url
    //e.g: http://localhost:8000/?per_page=1&page=2
    public function index(Request $request)
    {
      ($request->has('per_page')) ? $articles = Article::paginate($request->per_page) : $articles = Article::paginate(2);
      return $articles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      ($article=Article::create($request->all())) ? $status='success create data' : $status='fails create data' ;
      return response()->json(['status'=>$status, 'article'=>$article]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return Article::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // for test update must use header format 'x-www-form-urlencoded'
    // e.g : curl -H "Content-Type: application/x-www-form-urlencoded" -X PUT -d "title=Robana ya rob&content=lorem ipsum dolor camet" http://localhost:8000/articles/2
    public function update(Request $request, $id)
    {
      $article=Article::find($id);
      ($article->update($request->all())) ? $status = 'success update article' : $status = 'fails update article';
      return response()->json(['status'=>$status, 'article'=>$article]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      (Article::find($id)->delete()) ? $status='success delete article' : $status='fails delete article';
      return response()->json(['status'=>$status]);
    }
}
