@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $post ? route('admin.posts.update', ['post'=>$post->id]) : route('admin.posts.store') }}" method="POST">
    @csrf
    @isset($post)
        @method('PATCH')
    @endisset
    
            
    <div class="container">
        <div class="row">
    
            <div class="col-12 mb-3">
                <a href="{{ route('admin.posts.index') }}">Back to the list of POSTS</a>
            </div>

        </div>

        <div class="row card">

            <div class="col-12 my-3">
                <label for="title" class="form-label">Title of your Post</label>
                <input type="text" id="title" name="title" class="form-control" value="{{$post ? old('title', $post->title) : old('title')}}">
            </div>
            <div class="col-12 mb-3">
                <label for="author" class="form-label">Author of the Post</label>
                <input type="text" id="author" name="author" class="form-control" value="{{$post ? old('author', $post->author) : old('author')}}">
            </div>
            <div class="col-12 mb-3">
                <label for="content" class="form-label">Content of your Post</label>
                <textarea type="text" id="content" name="content" class="form-control">{{$post ? old('content', $post->content) : old('content')}}</textarea>
            </div>
            <div class="col-12 mb-3">
                <label for="image_url" class="form-label">Insert an image url</label>
                <input type="text" id="image_url" name="image_url" class="form-control" value="{{$post ? old('image_url', $post->image_url) : old('image_url')}}">
            </div>
            <div class="col-12 mb-3">
                <label for="category_id" class="form-label">Select a category</label>
                <select id="category_id" name="category_id">
                    <option value="">No Category</option>
                    @foreach ($categories as $category)                        
                        <option
                        @if ($category->id == $post->category_id)
                            selected
                        @endif
                        @if (old('category_id') == $category->id) selected @endif
                        value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach 

                </select>
            </div>
            <div class="col-12 mb-3">
                <button class="btn btn-primary" type="submit">{{ $post ? 'EDIT' : 'Create' }}</button>               
            </div>
        </div>

    </div>    
</form>
@endsection