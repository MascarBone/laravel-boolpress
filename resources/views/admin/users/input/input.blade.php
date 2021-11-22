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

<form action="{{ $user ? route('admin.users.update', ['user'=>$user->id]) : route('admin.users.store') }}" method="POST">
    @csrf
    @isset($post)
        @method('PATCH')
    @endisset
    
            
    <div class="container">
        <div class="row">
    
            <div class="col-12 mb-3">
                <a href="{{ route('admin.users.index') }}">Back to the list of USERS</a>
            </div>

        </div>

        <div class="row card">

            <div class="col-12 my-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{$user ? old('name', $user->name) : old('name')}}">
            </div>
            
            <div class="col-12 mb-3">
                <label for="email" class="form-label">Your Email</label>
                <input type="text" id="email" name="email" class="form-control" value="{{$user ? old('email', $user->userInfo->email) : old('email')}}">
            </div>
            
            <div class="col-12 mb-3">
                <label for="address" class="form-label">Your Address</label>
                <input type="text" id="address" name="address" class="form-control" value="{{$user ? old('address', $user->userInfo->address) : old('address')}}">
            </div>

            <div class="col-12 mb-3">
                <label for="phone" class="form-label">Insert a phone number</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{$user ? old('phone', $user->userInfo->phone) : old('phone')}}">
            </div>

            
            <div class="col-12 mb-3">
                <h4>Roles</h3>
                    @foreach ($roles as $role)
                    <div class="form-check-inline">
                        
                        <input type="checkbox" name="roles[]" value="{{$role->id}}" class="form-check-input" id="role-{{$role->id}}" @if (in_array($role->id, $userRoles)) checked @endif value="{{$role->id}}">                        
                        <label for="role-{{$role->id}}" class="badge badge-warning form-check-label">{{$role->name}}</label>
                    </div>                  
                    @endforeach 

                </select>
            </div>

            <div class="col-12 mb-3">
                <button class="btn btn-primary" type="submit">{{ $user ? 'EDIT' : 'Create' }}</button>               
            </div>
        </div>

    </div>    
</form>
@endsection