<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;
use App\Thread; 
use App\Post; 
use DB; 

/**
 * フォーラムの全般的なコントロール
 */
class ForumController extends Controller
{

    public function welcome() {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return  view('welcome');
    }

    /**
     * ホーム画面（スレッド一覧）表示.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function threadList()
    {
        $paginate_limit = config('simpleforum.thread_list.pagination_limit');
        $threads = Thread::paginate($paginate_limit);
        
        return view('home')->with('threads', $threads);
    }

    /**
     * スレッド詳細画面表示.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function threadDetail($id) {
        if (!isset($id)) {
            abort(404);
        }
        $thread = Thread::where('id', $id)->first();
        
        $posts = $thread->posts()->withTrashed()->get();

        $current_user_id = Auth::user()->id;

        $params = ['thread' => $thread, 'posts' => $posts, 'current_user_id' => $current_user_id];
        return view('thread', $params);
    } 
}
