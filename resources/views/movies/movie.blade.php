@extends('layouts.master') 
@section('content')

<h1 class="text-center my-2">{{$movie->title}}</h1>
<div class="movie-card card mb-4">
  <div class="d-flex flex-wrap justify-content-around py-2">
    <div class="movie-card card mw-500px align-self-start">
      @if($movie->poster_path !== null)
      <img class="card-img-top" src="http://image.tmdb.org/t/p/w500//{{$movie->poster_path}}" alt="{{$movie->title}}" />      @else
      <img class="card-img-top" src="https://via.placeholder.com/500x250.png?text=No+Poster+Available" alt="{{$movie->title}}"
      /> @endif
      <div class="card-body">
        <p class="card-text">{{ $movie->overview }}</p>
        <ul>
          <li>Genres: @foreach ($movie->genres as $genre)
            <span class="ml-1">{{$genre->name}}</span> @endforeach
          </li>
          <li>Budget: {{$movie->budget}} USD</li>
          <li>Runtime: {{$movie->runtime}} min</li>
          <li>Release date: {{$movie->release_date}}</li>
        </ul>
        <div class="mb-3">
          @if ($tot_rating && count($reviews) > 0)
          <div> BMD score: <img width="30%" src="{{ asset('assets/'.$tot_rating.'.svg') }}" /> </div> @else
          <p>This movie has not yet been rated at BMD</p>
          @endif @if($movie->vote_average)
          <p>TMDb score: <span style="font-weight: bold; font-size: 2em;">{{$movie->vote_average}}</span></p>
          @else
          <p>This movie has not yet been rated at TMDb</p>
          @endif

        </div>
        @if($user_id !== null && count($watchlists)>0)
        <form class="form-inline my-2 my-lg-0" method="POST" action="/watchlists">
          @csrf
          <input name="title" value="{{ $movie->original_title }}" hidden />
          <input name="movie_id" value="{{ $movie->id }}" hidden />
          <input name="poster_url" value="{{ $movie->poster_path }}" hidden />
          <select class="browser-default custom-select mr-sm-2" name="list_id" required>
            <option selected value="">Select watchlist:</option>
            @foreach ($watchlists as $wl)
            <option value="{{$wl->id}}">{{$wl->title}}</option>   
            @endforeach
        </select>
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add to list</button>
        </form>
        <p>
          <a class="btn btn-outline-success my-2 my-sm-0" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false"
            aria-controls="multiCollapseExample1">Create a new watchlist</a>
        </p>
        @elseif ($user_id === null)
        <a href="/login" class="btn btn-warning my-2 my-sm-0">Login to create a watchlist and add this movie</a> @endif
        <div class="row">
          <div class="col">
            <div class="collapse multi-collapse" id="multiCollapseExample1">
              <div class="card card-body">
                <form class="form-inline my-2 my-lg-0" method="GET" action="/watchlists/create">
                  @csrf
                  <input type="text" name="title" class="form-control mr-sm-2" value="" placeholder="Enter List Title" required/>
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add list</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="videos">
      @foreach ($trailers as $trailer)
      <h5 class="text-center">{{$trailer->name}}</h5>
      <div class="videocontainer mb-2">
        <div class="videowrapper">
          <iframe class="responsiveiframe" title="{{$trailer->name}}" src="https://www.youtube.com/embed/{{$trailer->key}}" allowfullscreen></iframe>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- CAST AND CREW -->
  <div class="container-fluid">
    <div class="row bg-dark">
      <div class="col-12 text-center  text-light py-2">
        <h2>Cast</h2>
        <div class="row my-2">
          @foreach($cast as $person)
          <div class="col-6 col-md-2 my-2">
            @if($person->profile_path === null)
            <img src="https://via.placeholder.com/92x138.png?text=NA" /> <br /> @else
            <img src="https://image.tmdb.org/t/p/w92/{{$person->profile_path}}" /> <br /> @endif
            <h5 class="text-light ml-2">{{$person->name}} as {{$person->character}}</h5>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-12 text-center py-2 text-light">
        <h2>Crew</h2>
        <div class="row my-2">
          @foreach($crew as $person)
          <div class="col-6 col-md-2 my-2">
            @if($person->profile_path === null)
            <img src="https://via.placeholder.com/92x138.png?text=NA" /> <br /> @else
            <img src="https://image.tmdb.org/t/p/w92/{{$person->profile_path}}" /> <br /> @endif
            <h5 class="text-light ml-2">{{$person->job}} - {{$person->name}}</h5>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div id="accordion">
    <div class="card mx-auto">
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
              <input type="text" class="form-control mx-3" name="headline" placeholder="Enter headline" required/>
            </div>
            <div class="row my-2">
              <label class="px-2" for="headline">Content</label>
              <textarea name="content" class="form-control mx-3" rows="5" placeholder="Enter content" required></textarea>
            </div>
            <select class="form-control mx-auto" name="rating" required>
                  <option selected disabled>Rate the movie</option>
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
    <div class="card mx-auto">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
           User Reviews
          </button>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          @if (count($reviews) > 0) @foreach ($reviews as $review)
          <div class="card-body edit-review-container-{{$review->id}}" style="display:none">
            @if($user_id !== null)
            <form method="POST" action="/reviews/{{$review->id}}">
              @csrf @method('PATCH')
              <input type="hidden" name="movie_tmdb_id" value="{{$movie->id}}">
              <input type="hidden" name="review_id" value="{{$review->id}}">
              <input type="hidden" name="movie_title" value="{{$movie->title}}">
              <div class="row my-2">
                <label class="px-2" for="headline">Headline</label>
                <input type="text" class="form-control mx-3" name="headline" value="{{$review->headline}}" required/>
              </div>
              <div class="row my-2">
                <label class="px-2" for="headline">Content</label>
                <textarea name="content" class="form-control mx-3" rows="5" value="{{$review->content}}" required>{{$review->content}}</textarea>
              </div>
              <select class="form-control mx-auto" name="rating" required>
                    <option selected disabled>New Rating</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
              <button class="btn btn-danger mt-2 edit-submit-{{$review->id}}" type="submit">Submit</button>
              <button class="btn btn-danger mt-2 edit-review-cancel">Cancel</button>
            </form>
            @endif
          </div>
          <hr/>
          <div class="container bg-lighter text-dark text-dark mb-2 p-2 container-review">
            <div class="d-flex row">
              <div class="mr-auto">
                <h4>{{$review->headline}}</h4>
              </div>
              @if ($user_id && $review->user_id === $user_id)
              <form class="edit-review">
                @csrf
                <input type="hidden" name="review_id" value="{{$review->id}}" />
                <button type="submit" class="btn btn-warning btn-edit-review">✎</button>
              </form>
              <div class="review-delete-btn ml-1">
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
            @if (count($comments) > 0)
            <div class="w-100 p-2">
              <button class="btn btn-success mb-2" type="button" data-toggle="collapse" data-target="#collapseComments{{$review->id}}"
                aria-expanded="false" aria-controls="collapseComments{{$review->id}}">
            Toggle comments
          </button>
            </div>
            <div class="collapse container" id="collapseComments{{$review->id}}">
              @foreach($comments as $comment) @if($comment->review_id === $review->id)
              <div class="bg-secondary card edit-comment-container-{{$comment->id}}" style="display:none">
                @if($user_id !== null)
                <form method="POST" action="/comments/{{$comment->id}}">
                  @csrf @method('PATCH')
                  <input type="hidden" name="comment_id" value="{{$comment->id}}">
                  <div class="row my-2 p-2">
                    <input type="text" name="content" class="form-control mx-3" value="{{$comment->content}}" required/>
                  </div>
                  <button class="btn btn-danger my-2 ml-1" type="submit">Edit Comment</button>
                  <button class="btn btn-warning my-2 edit-comment-cancel" type="button">Cancel</button>
                </form>
                @endif
              </div>
              <div class="card mb-2 bg-light text-dark p-2 container-comment">
                <div class="d-flex flex-row">
                  <div class="mr-auto">
                    <p>{{ $comment->content }}</p>
                  </div>
                  @if ($user_id && $comment->user_id === $user_id)
                  <form class="edit-comment">
                    @csrf
                    <input type="hidden" name="comment_id" value="{{$comment->id}}" />
                    <button type="submit" class="btn btn-warning edit-comment mr-1">✎</button>
                  </form>
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
                <small>Edited at:{{ $comment->updated_at }}</small> @endif
              </div>
              @endif @endforeach
            </div>
            @endif
            <div class="mb-2 bg-white text-dark p-2 mt-2 container">
              @if ($user_id !== null)
              <h5 class="mt-2">Add a comment:</h5>
              <form method="POST" action="/comments">
                @csrf
                <input type="hidden" name="movie_tmdb_id" value="{{$movie->id}}">
                <input type="hidden" name="review_id" value="{{$review->id}}">
                <div class="row my-2 p-2">
                  <input type="text" name="content" class="form-control mx-3" placeholder="Enter content" required/>
                </div>
                <button class="btn btn-danger my-2 mx-3" type="submit">Submit</button>
              </form>
              @else
              <button href="/login" class="btn btn-warning my-2 my-sm-0">Login to comment</button> @endif
            </div>
          </div>
        </div>
        @endforeach @endif @if (count($reviews) == 0)
        <h5>No reviews for this movie yet!</h5>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection