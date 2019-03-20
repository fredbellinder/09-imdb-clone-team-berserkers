@extends('layouts.master')

@section('content')
    <h2>TMDB Api test</h2>
    <ul>
        <li><?= $movie->original_title ?></li>
    </ul>
@endsection
