@extends('layouts.master') 
@section('content') @if($errors->any())
<div class="jumbotron text-center">
  <h3>{{ $errors->first() }}
    <h3>
</div>
@endif
<div class="movie-card card m-4">
  <div class="movie-card card mx-auto mt-5 mb-5 w-50">
    <img class="card-img-top" src="http://image.tmdb.org/t/p/w300//{{$movie->poster_path}}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{ $movie->original_title }} ({{ $movie->release_date }})</h5>
      <p class="card-text">{{ $movie->overview }}</p>
      <div class="mb-3">
        <img src="{{ asset('assets/'.$tot_rating.'.svg') }}" />
      </div>
      @if($user_id !== null && count($watchlists)>0)
      <form class="form-inline my-2 my-lg-0" method="POST" action="/watchlists">
        @csrf
        <input name="title" value="{{ $movie->original_title }}" hidden />
        <input name="movie_id" value="{{ $movie->id }}" hidden />
        <input name="poster_url" value="{{ $movie->poster_path }}" hidden />
        <select class="browser-default custom-select" name="list_id" required>
        <option selected value="">Select watchlist:</option>
        @foreach ($watchlists as $wl)
        <option value="{{$wl->id}}">{{$wl->title}}</option>   
        @endforeach
      </select>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add to list</button>
      </form>
      @elseif($watchlists !== null && count($watchlists) === 0)
      <a href="/watchlists" class="" type="submit">
      <button>
      Create new list
      </button> 
    </a> @elseif ($user_id === null)
      <a href="/login" class="btn btn-warning my-2 my-sm-0">Login to create a watchlist and add this movie</a> @endif
    </div>
  </div>
  <div id="accordion">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Write Review
          </button>
        </h5>
      </div>
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          @if($user_id !== null)
          <form method="POST" action="/reviews">
            @csrf
            <input type="hidden" name="movie_tmdb_id" value="{{$movie->id}}">
            <input type="hidden" name="movie_title" value="{{$movie->title}}">
            <div class="row my-2">
              <label class="px-2" for="headline">Headline</label>
              <input type="text" name="headline" placeholder="Enter headline" />
            </div>
            <div class="row my-2">
              <label class="px-2" for="headline">Content</label>
              <textarea name="content" placeholder="Enter content"></textarea>
            </div>
            <select class="browser-default custom-select" name="rating" required>
                  <option selected>Rate the movie</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
            <button class="btn btn-danger mt-2" type="submit">Submit</button>
          </form>
          @else
          <a href="/login" class="btn btn-warning my-2 my-sm-0">Login to write a review</a> @endif
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
           User Reviews
          </button>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          @if (count($reviews) > 0) @foreach ($reviews as $review)
          <div class="container bg-lighter text-dark text-dark mb-2 p-2">
            <h4>{{$review->headline}}</h4>
            <p>{{$review->content}}</p>
            <div class="mb-3">
              <img src="{{ asset('assets/'.$review->rating.'.svg') }}" />
            </div>
            @if (count($comments) > 0)
            <button class="btn btn-success mb-2" type="button" data-toggle="collapse" data-target="#collapseComments{{$review->id}}"
              aria-expanded="false" aria-controls="collapseComments{{$review->id}}">
            Toggle comments
          </button>
            <div class="collapse" id="collapseComments{{$review->id}}">
              @foreach($comments as $comment) @if($comment->review_id === $review->id)
              <div class="card mb-2 bg-light text-dark p-2">
                <p>{{ $comment->content }}</p>
                <small>By: {{ $comment->user_name }}</small>
                <small>{{ $comment->created_at }}</small> @if($comment->created_at != $comment->updated_at)
                <small>Edited at:{{ $comment->updated_at }}</small> @endif
              </div>
              @endif @endforeach
            </div>
            @endif
            <div class="card mb-2 bg-light text-dark p-2">
              @if ($user_id !== null)
              <h6>Add a comment:</h6>
              <form method="POST" action="/comments">
                @csrf
                <input type="hidden" name="movie_tmdb_id" value="{{$movie->id}}">
                <input type="hidden" name="review_id" value="{{$review->id}}">
                <div class="row my-2 p-2">
                  <label class="px-2" for="headline">Content</label>
                  <input type="text" name="content" rows="2" cols="50" placeholder="Enter content" />
                </div>
                <button class="btn btn-danger mt-2" type="submit">Submit</button>
              </form>
              @else
              <a href="/login" class="btn btn-warning my-2 my-sm-0">Login to comment</a> @endif
            </div>
          </div>
        </div>
        @endforeach @endif
      </div>
    </div>
  </div>
</div>
</div>
@endsection