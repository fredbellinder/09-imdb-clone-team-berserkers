@extends('layouts.master')
@section('content')
<div class="grid-container">
  <div class="panel hot-year">
    <a class="py-2" href="/popular-this-year">
      <h2>Hottest movies this year</h2>
    </a>
  </div>
  <div class="panel hot-horror text-center align-middle">
    <a class="py-2" href="/top-horror-movies">
      <h2>Top 5 rated horror movies</h2>
    </a>
  </div>
  <div class="panel staff-pick text-center align-middle">
    <a class="py-2" href="#">
      <h2>Staff picks (NA)</h2>
    </a>
  </div>
</div>
@endsection
