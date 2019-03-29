<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;
use App\Thread; 
use App\Post; 
use DB; 

/**
 * スレッド内の投稿記事。いわゆるレス。
 */
class PostController extends Controller
{
    /**
     * ThreadにPostを追加する.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add(PostAddRequest $req) {
        $newPost = $req->all();
        $newPost["user_id"] = Auth::user()->id;
        Post::create($newPost);

        return redirect()->back();
    } 

    /**
     * Postを論理削除する。
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete(Request $request) {  
        $request->validate([
            'post_id' => 'required'
        ]);

        $post_id = $request->input('post_id');
        $post = Post::find($post_id);
        $post_user_id = $post->user->id;
        $current_user_id = Auth::user()->id;

        if ($post_user_id != $current_user_id) {
            abort(401);
        }

        $post->delete();

        return redirect()->back();
    } 
}
