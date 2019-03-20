@extends('layouts.master')

@section('content')
    <h2>TMDB Movies Search Query Results</h2>
    <ul>
        @foreach ($results as $match)
            <li>{{ $match->title }}
        @endforeach

    </ul>
@endsection
