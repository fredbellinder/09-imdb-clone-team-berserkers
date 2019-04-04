@extends('layouts.master') 
@section('content')

<div class="container">
  <a href="/movies/{{ $movie->id}}">
    <h1>{{ $review->movie_title }} ({{ $movie->release_date }}) </h1>
  </a>
  <div class="row">
    <div class="col-6 p-3">
      <a href="/movies/{{ $movie->id}}">
          @if($movie->poster_path !== null)
          <img src="http://image.tmdb.org/t/p/w300//{{$movie->poster_path}}" alt="{{$movie->title}}">
          @else
          <img class="card-img-top" src="https://via.placeholder.com/300x150.png?text=No+Poster+Available" alt="{{$movie->title}}"/>
          @endif
          </a>
    </div>
    <div class="col-6 p-3">
      <h3 class="card-text">{{ $review->headline }}</h3>
      <p class="card-text">{{ $review->content }}</p>
      <div class="mb-3">
        @if($review->rating === null)
        <img src="{{ asset('assets/null.svg') }}" /> @else
        <img src="{{ asset('assets/'.($review->rating*10).'.svg') }}" /> @endif
      </div>
    </div>
  </div>
</div>
@endsection