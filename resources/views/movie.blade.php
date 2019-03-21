@extends('layouts.master')

@section('content')
    <div class="card m-4" style="width: 18rem;">
            <img class="card-img-top" src="http://image.tmdb.org/t/p/w300//{{$movie->poster_path}}" alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">{{ $movie->original_title }} ({{ $movie->release_date }})</h5>
              <p class="card-text">{{ $movie->overview }}</p>
            </div>
          </div>
        <div> 

@endsection
