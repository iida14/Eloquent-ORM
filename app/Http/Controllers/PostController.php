<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //1.一覧表示
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    //2.作成フォーム表示
    public function create()
    {
        return view('posts.create');
    }

    //3.データ保存処理
    public function store(Request $request)
    {
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => now(), // 現在の日時を設定
        ]);

        return redirect('posts');
    }

    //4.編集フォーム表示
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    //5.データ更新処理
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('posts');
    }

    //6.データ削除処理
    public function delete($id)
    {
        $post = Post::findOrFail($id)->delete();

        return redirect('posts');
    }
}
