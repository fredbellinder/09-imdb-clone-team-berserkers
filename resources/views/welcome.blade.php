@extends('layouts.master')
@section('content')

<h1 class="text-center">Hottest of {{date("Y")}}</h1>
  @foreach ($list as $entry)
      <div class="card w-100 text-center">
        <div style="position:relative;height:600px;color:white;background:url('https://image.tmdb.org/t/p/w1280/{{$entry->backdrop_path}}');background-repeat:no-repeat;
          background-position: center center;">
          <div style="position:absolute;top:40%;width:100%;background:rgba(1,1,1,0.7)">
            <h2 class="align-bottom">{{$entry->title}}</h2>
            <h3 class="align-bottom">{{$entry->vote_count}} votes</h3>
            <h3 class="align-bottom">{{$entry->vote_average}} average grade</h3>
            <h3 class="align-bottom">{{$entry->popularity}} popularity</h3>
          </div>
        </div>
      </div>
  @endforeach

@endsection
