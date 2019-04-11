<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\history_user;


class HistoryUserController extends Controller
{
    public function index()
    {
        return history_user::all();
    }

    public function show($id)
    {
        return history_user::find($id);
    }

    public function store(Request $request)
    {
        return history_user::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $article = history_user::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = history_user::findOrFail($id);
        $article->delete();

        return 204;
    }
}
