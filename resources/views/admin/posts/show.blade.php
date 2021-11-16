@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('admin.posts.index') }}">Back to the list of POSTS</a>
        </div>

        <div class="card col-12">            
            <div class="d-flex">
                <img src="{{$post->image_url}}" class="col-4" alt="{{$post->title}}">
                <div class="card-header col-8">
                    <h4 class="card-title">{{$post->title}}</h4>     
                    <p class="card-text">Author: {{$post->author}}</p>
                    <p class="card-text"><small class="text-muted">{{$post->post_date}}</small></p>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">{{$post->content}}</p>       
            </div>
        </div>
    </div>
</div>
@endsection