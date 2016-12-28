<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article, App\User;
use Auth;
use Tymon\JWTAuth\JWTAuth;

class ArticlesController extends Controller
{
    public function __construct(JWTAuth $auth, Request $request) 
    {
      //for create token JWT run 
      //curl -X POST -F 'email=dwikunto@geeksfarm.com' -F 'password=12345678' http://localhost:8000/auth/login
      $this->middleware('jwt.auth', ['only'=>['store', 'update', 'delete']]);

      //get token from client header request
      //Authorization : Bearer <your_token>
      // dd($auth->getToken());

      //get user token from server that current active
      // $user = User::where('email', 'dwikunto@geeksfarm.com')->first();
      // dd($auth->fromUser($user));
    }

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
      $this->validate($request, [
        'title'=>'required',
        'content'=>'required'
      ]);
      $article= new Article($request->all());
      ($article=Auth::user()->articles()->save($article)) ? $status='success create data' : $status='fails create data' ;
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
      return (count(Article::find($id))) ? Article::find($id) : ['info'=>'article not found'];
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
      $this->validate($request, [
        'title'=>'required',
        'content'=>'required'
      ]);
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
      if ($article = Article::find($id)) 
        (Article::find($id)->delete()) ? $status='success delete article' : $status='fails delete article';
      else 
        $status = 'article not found';
      return response()->json(['status'=>$status]);
    }
}
