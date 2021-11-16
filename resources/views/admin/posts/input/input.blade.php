@extends('layouts.app')

@section('content')

    
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
                <input type="text" id="title" name="title" class="form-control" value="@isset($post){{$post->title}}
                @endisset">
            </div>
            <div class="col-12 mb-3">
                <label for="author" class="form-label">Author of the Post</label>
                <input type="text" id="author" name="author" class="form-control" value="@isset($post){{$post->author}}
                @endisset">
            </div>
            <div class="col-12 mb-3">
                <label for="content" class="form-label">Content of your Post</label>
                <textarea type="text" id="content" name="content" class="form-control">@isset($post){{$post->content}}
                    @endisset</textarea>
            </div>
            <div class="col-12 mb-3">
                <label for="image_url" class="form-label">Insert an image url</label>
                <input type="text" id="image_url" name="image_url" class="form-control" value="@isset($post){{$post->image_url}}
                @endisset">
            </div>
            <div class="col-12 mb-3">
                <button class="btn btn-primary" type="submit">{{ $post ? 'EDIT' : 'Create' }}</button>               
            </div>
        </div>

    </div>    
</form>
@endsection