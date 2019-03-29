<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Thread; 
use App\Post; 

class Thread extends Model
{

    /**
     * Threadに紐づく複数のPostを取得する.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts() {
       return $this->hasMany('App\Post');
    }

    /**
     * Threadの詳細ページのURLを取得する.
     * 
     * @return Illuminate\Routing\Route
     */
    public function getURL()  {
        return route('thread', ['id' => $this->id]);
    }

    /**
     * Thread内のPostにおける最終書き込み日時を取得する.
     * 
     * @return string
     */
    public function getLastPostedTime() {
        $timestamp = Post::where('thread_id', $this->id)->max('created_at');
        // NOTE: maxを使うとなぜかstringになるがCarbon型に変換しておいたほうが便利かもしれない

        return $timestamp;
    }
}
