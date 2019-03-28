@extends('layouts.master')
@section('content')
<div class="container bg-light">
    <form class="mt-2 p-4" method="GET" action="/advanced-search">
      <input name="query" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" required>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      <div class="row">
        <div class="col s6 m12 l12 py-2">
          @foreach ($genres as $genre)
          <label class="mr-4">
            <input type="checkbox" value="{{ $genre }}" />
            <span>{{ $genre }}</span>
          </label>
          @endforeach
        </div>
      </div>
    </form>
  </div>
  @endsection
  