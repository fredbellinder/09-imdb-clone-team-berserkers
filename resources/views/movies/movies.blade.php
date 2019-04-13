@extends('layouts.master')

@section('content')
<h2 class="text-center bg-light my-2">Results for "{{$query}}"</h2>
  <ul>
    @foreach ($results as $match)
    	<li>
				<div class="m-1 match-container bg-light p-1 mb-2">
          <div class="row">
            <div class="col-4  col-sm-2 offset-sm-2">
              <a href="/movies/{{ $match->id}}">
              @if($match->poster_path !== null)
              <img src="https://image.tmdb.org/t/p/w92//{{$match->poster_path}}">
              @else
              <img src="https://via.placeholder.com/45x68.png?text=X" alt="{{ $match->title }}"/>
            </a>
            @endif
          </div>
          <div class="col-8 col-sm-6">
              <a href="/movies/{{ $match->id}}"><h4><b>{{ $match->title }}</b> ({{ $match->release_date }})</h4></a>
              <p class="overview-text">
                @if(strlen($match->overview)>300) 
                {{substr($match->overview,0,300)."..."}}
                @else
                {{$match->overview}}
                @endif
              </p>
            </div>
          </div>
      	<div> 
      </li>
    @endforeach
  </ul>
@endsection
