@extends('layouts.master') 
@section('content')
<div class="movie-card card m-4">
  <img class="card-img-top" src="http://image.tmdb.org/t/p/w300//{{$movie->poster_path}}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">{{ $movie->original_title }} ({{ $movie->release_date }})</h5>
    <p class="card-text">{{ $movie->overview }}</p>
    <form class="form-inline my-2 my-lg-0" method="POST" action="/watchlists">
      @csrf
      <input name="title" value="{{ $movie->original_title }}" hidden />
      <input name="movie_id" value="{{ $movie->id }}" hidden />
      <input name="poster_url" value="{{ $movie->poster_path }}" hidden /> @if ($watchlists)
      <select class="browser-default custom-select" name="list_id" required>
        <option selected value="">Select watchlist:</option>
        @foreach ($watchlists as $wl)
        <option value="{{$wl->id}}">{{$wl->title}}</option>   
        @endforeach
      </select> @endif
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add to list</button>
    </form>
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
            <form method="POST" action="/watchlists/{{$entries['id']}}">
              @csrf 
              <input type="hidden" name="id" value="{{$entries['id']}}">
              <input type="hidden" name="id" value="{{$entries['id']}}">
              <input type="hidden" name="id" value="{{$entries['id']}}">
              <input type="hidden" name="id" value="{{$entries['id']}}">
              <button type="submit">X</button>
          </form>
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
            USER REVIEWS GO HERE
        </div>
      </div>
    </div>
  </div>
@endsection