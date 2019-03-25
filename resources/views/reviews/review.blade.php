@extends('layouts.master') 
@section('content')

<div class="container">
  <h1>{{ $review->headline }} - {{ $review->rating }} / 10</h1>
    <div class="row">
      <div class="col-6 p-3">
          <img src="http://image.tmdb.org/t/p/w300//{{$movie->poster_path}}" alt="Card image cap">
      </div>
      <div class="col-6 p-3">
        <h5 class="card-title">{{ $movie->original_title }} ({{ $movie->release_date }})</h5>
        <p class="card-text">{{ $review->content }}</p>
      </div>
    </div>
</div>

@endsection