@extends('layouts.master')

@section('content')
  <h2>TMDB Movies Search Query Results</h2>
  <ul>
    @foreach ($results as $match)
    	<li>
				<div class="m-1 match-container">
          <img src="http://image.tmdb.org/t/p/w45//{{$match->poster_path}}">
      	  <a href="/movies/{{ $match->id}}"><b>{{ $match->title }}</b> ({{ $match->release_date }})</a>
      	<div> 
      </li>
    @endforeach
  </ul>
@endsection
