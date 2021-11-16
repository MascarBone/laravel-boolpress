@extends('layouts.app')

@section('content')
    
<div class="container">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Post Title</th>
                <th scope="col">Post Author</th>
                <th scope="col">Post Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                
                <tr>
                    <th scope="row"><a href="{{ route('admin.posts.show', ['post' => $post->id]) }}">{{$post->title}}</a></th>
                    <td>{{$post->author}}</td>
                    <td>{{$post->post_date}}</td>
                </tr>

            @empty
                
                <tr>
                    <td colspan="3">There are no posts available</td>
                </tr>
                
            @endforelse
        
        </tbody>
    </table>

</div>

@endsection