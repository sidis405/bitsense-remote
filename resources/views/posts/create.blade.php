@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title">
        </div>

        <div class="form-group">
            <label>Body</label>
            <textarea type="text" class="form-control" name="body"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </form>
</div>

@stop
