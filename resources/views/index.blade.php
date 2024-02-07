@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url('/') }}" class="btn btn-primary">Home</a>
        @if ($posts->count())
            <div class="list-group">
                {{ $posts->links() }}
                @foreach ($posts as $post)
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">{{ $post->title }}</h4>
                        <p class="list-group-item-text">{{ $post->body }}</p>
                        <small>Comments:</small>
                        @if ($post->comments->count())
                            <ul>
                                @foreach ($post->comments as $comment)
                                    <li>{{ $comment->body }} - <em>{{ $comment->created_at->format('M d, Y') }}</em></li>
                                @endforeach
                            </ul>
                        @else
                            <p>No comments yet.</p>
                        @endif
                    </div>
                @endforeach
                {{ $posts->links() }}
            </div>            
        @else
            <p>No posts found.</p>
        @endif
        
    </div>
@endsection