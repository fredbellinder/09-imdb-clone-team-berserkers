@extends('layouts.master') 
@section('content')

<div class="container py-3 my-3  ">
  <div class="row">
    <header class="col-12 text-center mb-2">
      <a class="text-dark" href="/movies/{{ $movie->id}}">
        <h1>{{ $review->movie_title }} ({{ $movie->release_date }}) </h1>
      </a>
        <header>
  </div>
  <div class="row">
    <section class="col-12 col-sm-6 text-center">
      <h3>{{$review->headline}}</h3>
      <p>{{$review->content}}</p>
      <div class="mb-3">
        @if($review->rating === null)
        <img src="{{ asset('assets/null.svg') }}" /> @else
        <img src="{{ asset('assets/'.($review->rating*10).'.svg') }}" /> @endif
      </div>
      @if (!$review->approved)
      <p class="p-2 bg-danger text-light text-center">This review is pending approval by a moderator. Until it is approved, only you will be able to see it.</p>
      @else
      <p class="p-2 bg-success text-light text-center">This review has been approved by a moderator and is visible.</p>
      @endif
    </section>
    <section class="col-12 col-sm-6 text-center">
      <a href="/movies/{{ $movie->id}}">
        @if($movie->poster_path !== null)
        <img src="http://image.tmdb.org/t/p/w300//{{$movie->poster_path}}" alt="{{$movie->title}}">
        @else
        <img class="card-img-top" src="https://via.placeholder.com/300x150.png?text=No+Poster+Available" alt="{{$movie->title}}"/>
        @endif
        </a>
    </section>
  </div>
@endsection