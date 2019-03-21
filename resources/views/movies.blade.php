@extends('layouts.master')

@section('content')
  <h2>TMDB Movies Search Query Results</h2>
  <ul style="list-style-type:none">
    @foreach ($results as $match)
    	<li>
				<div style="margin:10px">
          <img src="http://image.tmdb.org/t/p/w45//{{$match->poster_path}}">
      	  <a href="/movies/{{ $match->id}}" style="text-decoration:none;color:black"><b>{{ $match->title }}</b> ({{ $match->release_date }})</a>
      	<div> 
      </li>
    @endforeach
  </ul>
@endsection
