@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Thanks for sending us an email!</h2>
            </div>
            <div class="col-12 links">
                <h4><a href="{{route('welcome')}}">Go to the welcome page</a></h4>
            </div>
        </div>
    </div>
@endsection