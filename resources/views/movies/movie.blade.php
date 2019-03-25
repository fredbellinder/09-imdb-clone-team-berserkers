@extends('layouts.master') 
@section('content')
<div class="card m-4" style="width: 18rem;">
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
@endsection