@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">スレッド一覧</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                    @foreach ($threads as $thread)
                        <li>
                            <a href="{{$thread->getURL()}}"> {{ $thread->name }} </a><br>
                            <span>作成日：{{ $thread->created_at}}</span>
                            <span>最終投稿日：{{ $thread->getLastPostedTime()}}</span>
                        </li> 
                    @endforeach
                    </ul>
                    {{ $threads->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
