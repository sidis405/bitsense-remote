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


    <table class="table my-4">
        <tr>
            <th>Title</th>
            <th>Body</th>
            <th>Author</th>
            <th>Date</th>
        </tr>
        @foreach ($posts as $post)
            <tr>
                <td><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->created_at->format('F j \'y') }}</td>
            </tr>
        @endforeach
    </table>

    {{ $posts->appends(request()->all())->links() }}
</div>

@stop
