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
                    <p>
                        @if ($post->category)
                            {{$post->category->name}}
                        @else
                            {{'N.D'}}
                        @endif
                    </p>
                    <p>
                        @forelse ($post->tags as $tag)                            
                            <span class="badge" style="background-color: {{$tag->color}} ">{{$tag->name}}</span>
                        @empty
                            NO Tags
                        @endforelse
                    </p>
                    <p class="card-text">Author: {{$post->author->name}}</p>
                    <p class="card-text"><small class="text-muted">{{$post->post_date}}</small></p>
                    @if(Auth::user()->id == $post->author->id)
                    {{-- {{route('admin.posts.destroy',['post'=>$post])}} --}}
                        <form id="form-delete" action="" method="POST" data="{{$post->title}}" class="text-right">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">{{$post->content}}</p>       
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        const info = document.querySelector('#form-delete');
        
        console.log(info);
        info.addEventListener('submit', function(event){
            event.preventDefault();
            const titolo = info.getAttribute('data');
            const confirm = window.confirm('Stai cercando di eliminare: ' + titolo);
            if(confirm) this.submit();
        }, false);
        
    </script>
@endsection