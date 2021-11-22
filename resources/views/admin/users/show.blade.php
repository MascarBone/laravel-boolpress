@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('admin.users.index') }}">Back to the list of Users</a>
        </div>

        <div class="card col-12">    
                <div class="card-header">
                    <h4 class="card-title">{{$user->name}}</h4> 
                </div>
                    
                <div class="card-body">
                    @if ($user->userInfo())   
                        <p>
                            {{$user->userInfo->email}}
                        </p>
                        <p class="card-text"><small class="text-muted">{{$user->userInfo->address}}</small></p>                        
                    @endif
                    <p>
                        @foreach ($user->roles as $role)                            
                            <span class="badge badge-warning">{{$role->name}}</span>
                        @endforeach
                    </p>
                </div>>       
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