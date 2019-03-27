@extends('layouts.master')

@section('content')
<div class="container">
  <h1 class="text-center">Welcome back {{ $user_name }} - {{ $user_id }}</h1>
  <h2>My Watchlists</h2>
  <ul> @if (count($watchlists) > 0) @foreach ($watchlists as $entry)
      <li>
        <a href="/watchlists/{{$entry->id}}">{{ $entry->title }}</a>
      </li>
      @endforeach @else
      <p>You haven't made any lists yet</p>
      @endif
  </ul>
  <h2>My Reviews</h2>
  <ul> @if (count($reviews) > 0) @foreach ($reviews as $entry)
      <li>
        <a href="/reviews/{{$entry->id}}?movie_id={{ $entry->movie_tmdb_id}}">{{ $entry->movie_title }} ({{ $entry->rating }}/10)</a>
      </li>
      @endforeach @else
      <p>You haven't made any reviews yet</p>
      @endif
  </ul>
  <h2>My Comments</h2>
  @if (count($comments) > 0) @foreach ($comments as $comment)
      <div class="card mb-2 p-2">
        <h4>{{$comment->headline}}</h4>
        <p>{{$comment->content}}</p>
        <p>Comment ID: {{$comment->id}}</p>
      </div>
      </li>
      @endforeach @else
      <p>You haven't made any comments yet</p>
      @endif
  </ul>
</div>
@endsection

