@extends('layouts.master') 
@section('content')

<h1>Watchlists</h1>
@if (count($list) > 0)
<ul class="list-group">
    @foreach ($list as $entries)
    <li class="list-group-item d-flex justify-content-between">
    <a href="/watchlists/{{$entries['id']}}"><h5>{{$entries['title']}}</h5></a>
        <form method="POST" action="/watchlists/{{$entries['id']}}">
            @csrf @method("DELETE")
            <input type="hidden" name="id" value="{{$entries['id']}}">
            <button class="btn btn-danger" type="submit">X</button>
        </form>
    </li>
    @endforeach
</ul>
@else
    <p> No list added:(</p>
@endif

<form class="form-inline my-2" method="GET" action="/watchlists/create">
    @csrf
    <input type="text" name="title" class="form-control mr-sm-2" value="" placeholder="Enter List Title" required/>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add list</button>
</form>
@endsection