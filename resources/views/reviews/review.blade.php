@extends('layouts.master') 
@section('content')

<div class="container">
  <h1>{{ $review->movie_title }} ({{ $movie->release_date }}) </h1>
    <div class="row">
      <div class="col-6 p-3">
          <img src="http://image.tmdb.org/t/p/w300//{{$movie->poster_path}}" alt="Card image cap">
      </div>
      <div class="col-6 p-3">
        <h3 class="card-text">{{ $review->headline }}</h3>
        <p class="card-text">{{ $review->content }}</p>
        <p>Rating: {{ $review->rating }} / 5</p>
      </div>
    </div>
</div>

@endsection