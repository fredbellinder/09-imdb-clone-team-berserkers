@extends('layouts.master')
@section('content')

<h1 class="text-center">Welcome to Berserker Movies!</h1>
<div class="container">
  <div class="row">
    <div class="col-12 col-lg-4">
      <h2>Need some inspiration?</h2>
      <h3>Check out some of our top lists:</h3>
      <ul class="list-group">
        <li class="list-group-item bg-secondary"><a class="text-white" href="/popular-this-year">Hottest movies this year</a></li>
        <li class="list-group-item bg-secondary"><a class="text-white" href="/top-horror-movies">Top 5 rated horror movies</a></li>
        <li class="list-group-item bg-secondary"></li>
      </ul>
    </div>
  </div>
</div>

@endsection
