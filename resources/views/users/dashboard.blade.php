@extends('layouts.master') 
@section('content')

<div class="container-fluid">
  <h1 class="text-center mb-4 bg-warning">Welcome back {{ $user_name }}</h1>
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
      <ul class="list-group"> @if (count($reviews) > 0) @foreach ($reviews as $entry)
        <li class="list-group-item list-group-item-warning text-body">
          <h3><a href="/reviews/{{$entry->id}}?movie_id={{ $entry->movie_tmdb_id}}">{{ $entry->movie_title }}</a></h3>
          @if($entry->rating === null)
          <img src="{{ asset('assets/null.svg') }}" /> @else
          <img src="{{ asset('assets/'.($entry->rating*10).'.svg') }}" /> @endif @if (!$entry->approved)
          <p>Your review is pending approval by a moderator. Until it is approved, only you will be able to see it.</p>
          @endif
        </li>
        @endforeach @else
        <p>You haven't made any reviews yet</p>
        @endif
      </ul>
      <h2>My Comments</h2>
      @if (count($comments) > 0) @foreach($comments as $comment)
      <div class="card mb-2 bg-light text-dark p-2">
        <div class="d-flex flex-row">

          <div class="w-100">
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
      <p>Your comment is pending approval by a moderator. Until it is approved, only you will be able to see it.</p>
      @endif @endforeach @else
      <p>You haven't made any comments yet</p>
      @endif
      </ul>
    </div>
    @if ($administrate_reviews && $administrate_comments)
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

<script>
  const commentToDelete = $('.delete-comment');
     function deleteComment (event) {
        event.preventDefault();
        $.ajax(
          {
          url: `/comments/${event.target[2].value}`,
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        }).done(() => {
        $(this).closest('.card').remove();
        });
      }
      commentToDelete.on('submit', deleteComment)

</script>
@endsection