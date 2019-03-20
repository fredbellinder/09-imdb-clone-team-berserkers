<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>WatchList</h1>
    
    <ul>    @if (count($list) > 0) 
        
        @foreach ($list as $entries) 
        <li>
            <div class="card">
                <h5>{{$entries['title']}}</h5>
                <img src="{{$entries['poster_url']}}">
            </div>
        </li>
        @endforeach
        @else
            <p> Nothing added to list :(</p>
        @endif
    </ul>
</body>
</html>