@extends('layouts.app')

@section('content')
    
<div class="container">

    <div class="row mb-3">
        <div class="col-12 mb-3">
            <a href="{{route('admin.posts.create')}}" class="btn btn-secondary">Create a new POST</a>
        </div>
        <div class="col-12">
            @if (session('info'))
                <div class="col-12 alert alert-success">
                    <h3>"{{ session('info') }}" deleted with success</h3>
                </div>
            @endif
        </div>
    </div>

    <div class="row">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Post Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Post Author</th>
                    <th scope="col">Post Date</th>                    
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    
                    <tr>
                        <th scope="row"><a href="{{ route('admin.posts.show', ['post' => $post->id]) }}">{{$post->title}}</a></th>
                        <td>
                            @if ($post->category)
                                {{$post->category->name}}
                            @else
                                {{'N.D'}}
                            @endif
                        </td>
                        <td>{{$post->author->name}}</td>  
                        <td>{{$post->post_date}}</td>
                        <td><a href="{{route('admin.posts.edit', ['post'=>$post->id])}}">EDIT</a></td>
                    </tr>
    
                @empty
                    
                    <tr>
                        <td colspan="4">There are no posts available</td>
                    </tr>
                    
                @endforelse
            
            </tbody>
        </table>

        {{ $posts->links() }}
    
    </div>

</div>

@endsection