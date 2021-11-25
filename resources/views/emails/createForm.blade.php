@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('guests.emails.storeForm') }}" method="POST" class="col-12">
                @csrf
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="object">Object</label>
                    <input type="text" class="form-control" id="object" name="object">
                </div>
                <div class="form-group">
                    <label for="content">Content of you email</label>
                    <textarea class="form-control" id="content" name="content" placeholder="Inserisci il contenuto dell'email"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>  
        </div>
    </div>
  
@endsection
