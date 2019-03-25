@extends('layouts.master') 
@section('content')

<h1>WatchLists plural</h1>

<ul> @if (count($list) > 0) @foreach ($list as $entries)
    <li>
        <div class="card">
            <h5>{{$entries['title']}}</h5>
            <a href="/watchlists/{{$entries['id']}}">Check out list</a>
        </div>
    </li>
    @endforeach @else
    <p> Nothing added to list :(</p>
    @endif
</ul>

<form class="form-inline my-2 my-lg-0" method="GET" action="/watchlists/create">
    @csrf
    <input type="text" name="title" class="form-control mr-sm-2" value="" placeholder="Enter List Title" required/>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add list</button>
</form>
@endsection