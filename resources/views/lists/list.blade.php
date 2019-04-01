@extends('layouts.master') 
@section('content')
<div class="list-container p-1 mt-2 w-75 mx-auto">
    <h1 class="text-center ">{{$title}}</h1>
    <ul> @if (count($list) > 0) @foreach ($list as $entries)

        <li class>
            <div class="list-item-container bg-light p-1 mt-2 mx-auto">

                <div class="list-item-img px-5">

                    @if($entries['poster_url'] !== null)
                    <img width="100" src="http://image.tmdb.org/t/p/w185//{{$entries['poster_url']}}"> @else
                    <img src="https://via.placeholder.com/45x68.png?text=X" alt="{{ $entries['title'] }}" /> @endif
                </div>
                <div>

                    <a class="list-item-title" href="/movies/{{ $entries['id']}}">
                        <h4>{{ $entries['title'] }}</h4>
                    </a>
                </div>


                <div>
                    <form class="list-item-form pr-5" method="POST" action="/watchlists/{{$entries['id']}}">
                        @csrf @method("PATCH")
                        <input type="hidden" name="id" value="{{$entries['id']}}">
                        <input type="hidden" name="list_id" value="{{$list_id}}">
                        <button class="btn btn-danger btn-lg" type="submit">X</button>
                    </form>
                </div>
        </li>
        @endforeach @else
        <p> Nothing added to list :( oooor you tried to watch a watchlist which aint yours! Watch out!</p>
        @endif
    </ul>
    </div>
@endsection