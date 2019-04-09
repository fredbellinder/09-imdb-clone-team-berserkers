@extends('layouts.master') 
@section('content')
<div class="container">
  <h1 class="text-center">Welcome back {{ $user_name }}</h1>
  <div class="innerContainer d-flex justify-content-between">
    <div class="leftContainer">
      <h2>My Watchlists</h2>
      <ul> @if (count($watchlists) > 0) @foreach ($watchlists as $entry)
        <li>
          <h3><a class="text-dark" href="/watchlists/{{$entry->id}}">{{ $entry->title }}</a>
            <h3>
        </li>
        @endforeach @else
        <p>You haven't made any lists yet</p>
        @endif
      </ul>
      <h2>My Reviews</h2>
      <ul> @if (count($reviews) > 0) @foreach ($reviews as $entry)
        <li>
          <h3><a class="text-dark" href="/reviews/{{$entry->id}}?movie_id={{ $entry->movie_tmdb_id}}">{{ $entry->movie_title }}</a></h3>
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
    </div>
    @if ($administrate_reviews && $administrate_comments)
    <div class="rightContainer">
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
          statusCode: {
    200: function() {
      alert( "page not found" );
    }
  }
        }).done(() => {
        $(this).closest('.card').remove();
        });
      }
      commentToDelete.on('submit', deleteComment)

</script>
@endsection