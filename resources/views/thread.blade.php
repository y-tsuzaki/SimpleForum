@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">スレッド名：{{ $thread->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="posts-list">
                    @foreach ($posts as $key => $post)
                        <div class="post">
                            <div class="post__seq-no"> #{{ $key + 1 }} </div>
                            @if ($post->trashed())
                                <div class="post__deleted-message">このメッセージは削除されました。<div>
                            @else
                                <div class="post__subject"> 件名：{{ $post->subject }} </div>
                                <div class="post__user">ユーザ：{{ $post->user->name }}</div>
                                <div class="post__posted-datetime"> 投稿日時：{{ $post->created_at }}</div>
                                <div class="post__body"> 本文：{!! nl2br(e($post->body)) !!} </div>
                                @if ($post->user->id == $current_user_id)
                                    <form action="{{route('deletePost')}}" method="POST" class="post-form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="post_id" value="{{$post->id}}">
                                        <input type="submit" class="btn btn-primary" class="post__delete-button" value="削除">
                                    </form>
                                @endif
                            @endif
                        </div>
                        <hr>
                    @endforeach
                    @if (empty($post))
                        <p>まだ投稿がありません。</p>
                    @endif
                    </div>
                </div>
            </div>
            <div class="card" id="addPostForm">
                <div class="card-header">新規投稿</div>
                <div class="card-body">
                    <form action="{{route('addPost')}}" method="POST" class="post-form">
                        {{ csrf_field() }}
                            <input type="hidden" name="thread_id" value="{{ $thread->id }}" />
                        <div class="form-group mb-3">
                            <label for="new-post-subject">件名</label>
                            <input id="new-post-subject" type="text" class="form-control {{ $errors->has('subject') ? 'is-invalid' : ''}}" name="subject" value="{{ old('subject') }}"/>
                            <span class="invalid-feedback">{{$errors->first('subject')}}</span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="new-post-body">本文</label>
                            <textarea id="new-post-body" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" name="body">{{ old('body') }}</textarea>
                            <span class="invalid-feedback">{{$errors->first('body')}}</span>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary" value="投稿" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
