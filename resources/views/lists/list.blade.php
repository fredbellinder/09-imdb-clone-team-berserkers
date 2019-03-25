@extends('layouts.master') 
@section('content')

<div>
  <ul> @if (count($list) > 0) @foreach ($list as $entries)
    <li>
      <div class="card">
        <h5>{{$entries['title']}}</h5>
        <img src="http://image.tmdb.org/t/p/w185{{$entries['poster_url']}}">
      </div>
    </li>
    @endforeach @else
    <p> Nothing added to list :( oooor you tried to watch a watchlist which aint yours! Watch out!</p>
    @endif
  </ul>
</div>
@endsection