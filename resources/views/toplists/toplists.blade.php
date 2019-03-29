@extends('layouts.master') 
@section('content')

<h1 class="text-center">{{ $title }}</h1>
@foreach ($list as $entry)
<a class="text-berserker-primary" href="/movies/{{$entry->id}}">
  <div class="card w-100 text-center">
    <div class="welcome-container" style="background-image:url('https://image.tmdb.org/t/p/w1280/{{$entry->backdrop_path}}');">
      <div class="welcome-container-info">
        <h2 class="align-bottom">{{$entry->title}}</h2>
        <h3 class="align-bottom">{{$entry->vote_count}} votes</h3>
        <h3 class="align-bottom">{{$entry->vote_average}} average grade</h3>
        <h3 class="align-bottom">{{$entry->popularity}} popularity</h3>
      </div>
    </div>
  </div>
</a>
@endforeach
@endsection