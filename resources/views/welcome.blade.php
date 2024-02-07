@extends('layouts.app')
@section('content')   
    <p>Click the button below to import posts and comments.</p>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <a href="{{ url('/import') }}" class="btn btn-primary">Import Posts</a>
    <a href="{{ url('/posts') }}" class="btn btn-primary">See Posts</a>
@endsection
