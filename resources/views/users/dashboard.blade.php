@extends('layouts.master') 
@section('content')
<div class="container">
  <h1 class="text-center">Welcome back {{ $user_name }}</h1>
  <div class="innerContainer d-flex justify-content-between">
    <div class="leftContainer">
    <h2>My Watchlists</h2>
    <ul class="list-group"> @if (count($watchlists) > 0) @foreach ($watchlists as $entry)
      <li class="list-group-item list-group-item-warning text-body">
        <h4><a href="/watchlists/{{$entry->id}}">{{ $entry->title }}</a></h4>
      </li>
      @endforeach @else
      <p>You haven't made any lists yet</p>
      @endif
    </ul>
    <hr />
    <h2>My Reviews</h2>
    <ul class="list-group"> @if (count($reviews) > 0) @foreach ($reviews as $entry)
      <li class="list-group-item list-group-item-warning text-body">
        <h3><a href="/reviews/{{$entry->id}}?movie_id={{ $entry->movie_tmdb_id}}">{{ $entry->movie_title }}</a></h3>
        @if($entry->rating === null)
        <img src="{{ asset('assets/null.svg') }}" /> @else
        <img src="{{ asset('assets/'.($entry->rating*10).'.svg') }}" /> @endif
        @if (!$entry->approved)
          <p class="mt-2">Your review is pending approval by a moderator.
          Until it is approved, only you will be able to see it.</p>
        @endif
      </li>
      @endforeach @else
      <p>You haven't made any reviews yet</p>
      @endif
    </ul>
    <hr />
    <h2>My Comments</h2>
    @if (count($comments) > 0) @foreach($comments as $comment)
    <div class="card mb-2 bg-light text-dark p-2">
      <p>{{ $comment->content }}</p>
      <p>By: {{ $comment->user_name }}</p>
      <p>{{ $comment->created_at }}</p>
      @if($comment->created_at != $comment->updated_at)
      <p>Edited at:{{ $comment->updated_at }}</p>
      @endif
    </div>
      @if (!$comment->approved)
        <p>Your comment is pending approval by a moderator.
        Until it is approved, only you will be able to see it.</p>
      @endif
    @endforeach @else
    <p>You haven't made any comments yet</p>
    @endif
    </ul>
    </div>
    @if ($administrate_reviews && $administrate_comments)
    <div class="rightContainer">
      <a href="admin/reviews"><h2>Administrate Reviews</h2></a>
      <a href="admin/comments"><h2>Administrate Comments</h2></a>
    </div>
    @endif
  </div>
</div>
@endsection