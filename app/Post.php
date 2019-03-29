<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Thread; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = ['thread_id', 'user_id', 'subject', 'body'];
    
    public function user() {
        return $this->belongsTo('App\User');
     }
     
}
