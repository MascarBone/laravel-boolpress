@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-3">
        <div class="col-12 mb-3">
            <a href="{{route('admin.users.create')}}" class="btn btn-secondary">Create a new User</a>
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
                    <th scope="col">User ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">User Level</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    
                    <tr>
                        <th scope="row"><a href="{{ route('admin.users.show', ['user' => $user->id]) }}">{{$user->name}}</a></th>
                        <td>{{$user->id}}</td>  
                        <td>
                            @foreach ($user->roles as $role)
                                <span>{{$role->name}}</span>
                            @endforeach
                        </td>
                        <td><a href="{{route('admin.users.edit', ['user'=>$user->id])}}">EDIT</a></td>
                    </tr>
    
                @empty
                    
                    <tr>
                        <td colspan="4">There are no users available</td>
                    </tr>
                    
                @endforelse
            
            </tbody>
        </table>
    
    </div>

</div>
@endsection