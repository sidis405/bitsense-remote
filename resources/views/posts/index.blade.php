@extends('layouts.app')

@section('content')

<div class="container">


    <h3>Posts <small class="text-muted font-weight-light"></small>
        <span class="badge badge-secondary">{{ number_format($posts->total()) }} records</span>
    </h3>

    <h4>
    @auth
        <span class="badge badge-success pull-right">
            <a href="{{ route('posts.create') }}">Create Post</a>
        </span>
    @endauth
    </h4>

    <PostsTable :posts="{{ json_encode($posts) }}"></PostsTable>



    {{ $posts->appends(request()->all())->links() }}
</div>

@stop
