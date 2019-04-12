@extends('layouts.master') 
@section('content')
<div class="grid-container">
  <a class="panel hot-year py-2" href="/popular-this-year">

    <h2 class="panel-link">Hottest movies this year</h2>

  </a>
  <a class="panel hot-horror text-center align-middle py-2" href="/top-horror-movies">

    <h2 class="panel-link">Top 5 rated horror movies of all time</h2>

  </a>
  <a class="panel hot-comedy text-center align-middle py-2" href="/top-comedy-movies">

    <h2 class="panel-link">Top 5 popular comedies of the year</h2>

  </a>
</div>
@endsection