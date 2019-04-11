<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Article;
use Illuminate\Support\Facades\DB;
class ArticleController extends Controller
{
    public function index()
    {
        return  DB::table('articles')->paginate(10);
    }


    public function show($id)
    {
        return Article::find($id);
    }

    public function store(Request $request)
    {
        return Article::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return 204;
    }
    

}
