@extends('layouts.master') 
@section('content')

<h1 class="text-center mb-4 bg-warning">Welcome back {{ $user_name }}</h1>
<div class="container-fluid">
  <div class="inner-container d-flex flex-wrap justify-content-around">
    <div class="left-container">
      <h2>My Watchlists</h2>
      <ul class="list-group"> @if (count($watchlists) > 0) @foreach ($watchlists as $entry)
        <li class="list-group-item list-group-item-warning d-flex justify-content-between text-body">
          <a href="/watchlists/{{$entry['id']}}">
            <h5>{{$entry['title']}}</h5>
          </a>
          <form method="POST" action="/watchlists/{{$entry['id']}}">
            @csrf @method("DELETE")
            <input type="hidden" name="id" value="{{$entry['id']}}">
            <button class="btn btn-danger" type="submit">X</button>
          </form>
        </li>
        </li>
        @endforeach @else
        <p>You haven't made any lists yet</p>
        @endif
        <form class="form-inline my-2" method="GET" action="/watchlists/create">
          @csrf
          <input type="text" name="title" class="form-control mr-sm-2" value="" placeholder="Enter List Title" required/>
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add list</button>
        </form>
      </ul>
      <hr/>
      <h2>My Reviews</h2>
      <ul class="list-group"> @if (count($reviews) > 0) @foreach ($reviews as $review)
        <li class="list-group-item list-group-item-warning text-body container-review dashboard-review">
          <div class="container bg-lighter text-dark text-dark">
            <div class="d-flex flex-wrap justify-content-between">
              <div>
                <h4><a href="/reviews/{{$review->id}}?movie_id={{ $review->movie_tmdb_id}}">{{ $review->movie_title }}</a></h4>
              </div>
              @if ($user_id && $review->user_id === $user_id)
              <div class="review-delete-btn">
                <form class="delete-review">
                  @csrf @method('DELETE')
                  <input type="hidden" name="id" value="{{$review->id}}" />
                  <button type="submit" class="btn btn-danger">X</button>
                </form>
              </div>
            </div>
            @endif
            <div class="mb-3 row w-100">
              @if($review->rating === null)
              <img class="flex-start" src="{{ asset('assets/null.svg') }}" /> @else
              <img class="flex-start" src="{{ asset('assets/'.($review->rating*10).'.svg') }}" /> @endif
            </div>
            <p class="w-100">{{$review->content}}</p>
            @if (!$review->approved)
            <p>Your review is pending approval by a moderator. Until it is approved, only you will be able to see it.</p>
            @endif
          </div>
        </li>
        @endforeach @else
        <p>You haven't made any reviews yet</p>
        @endif
      </ul>
      <hr />
      <h2>My Comments</h2>
      @if (count($comments) > 0) @foreach($comments as $comment)
      <div class="card mb-2 bg-light text-dark p-2 container-comment">
        <div class="d-flex flex-row">
          <div class="mr-auto">
            <p>{{ $comment->content }}</p>
          </div>
          @if ($user_id && $comment->user_id === $user_id)
          <div class="comment-delete-btn">
            <form class="delete-comment">
              @csrf @method('DELETE')
              <input type="hidden" name="id" value="{{$comment->id}}" />
              <button type="submit" class="btn btn-danger">X</button>
            </form>
          </div>
          @endif
        </div>
        <small>By: {{ $comment->user_name }}</small>
        <small>{{ $comment->created_at }}</small> @if($comment->created_at != $comment->updated_at)
        <small>Edited at:{{ $comment->updated_at }}</small> @endif @if (!$comment->approved)
        <p style="background-color:rgb(255,80,80); color: white;">Your comment is pending approval by a moderator. Until it is approved, only you will be able to see it.</p>
        @endif
      </div>
      @endforeach @else
      <p>You haven't made any comments yet</p>
      @endif @if ($administrate_reviews && $administrate_comments)
      <div class="right-container">
        <a href="admin/reviews">
          <h2>Administrate Reviews</h2>
        </a>
        <a href="admin/comments">
          <h2>Administrate Comments</h2>
        </a>
      </div>
      @endif
    </div>
  </div>
@endsection