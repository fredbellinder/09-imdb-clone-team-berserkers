@extends('layouts.master')

@section('content')
<div class="container">
  <h1 class="text-center">Welcome back {{ $user_name }}</h1>
  <h2>My Watchlists</h2>
  <ul>
    @foreach ($watchlist as $entry)
      <li><a href="/watchlists/{{$entry->id}}">{{ $entry->title }}</a></li>
    @endforeach
  </ul>
  <h2>My Reviews - STATIC WITH DEAD LINKS - INTENDED AS TEMPLATE</h2>
  <ul>
    <li><a href="#">Fight Club (1/5)</a></li>
    <li><a href="#">Us (5/5)</a></li>
    <li><a href="#">Get Out (5/5)</a></li>
  </ul>
</div>


@endsection
