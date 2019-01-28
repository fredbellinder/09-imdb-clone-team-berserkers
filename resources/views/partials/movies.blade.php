<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>TEST</h1>

    {{-- dd{{$movies}} --}}

<table class="table table-dark">
    <thead>
        <tr>
            <th>Id</th>
            <th>title</th>
            <th>plot</th>
            <th>year</th>
            <th>country</th>
            <th>runTime</th>
        </tr>
    </thead>

    <tbody> @foreach($movies as $movie) 
        <tr>
            <td>{{ $movie->id }}</td>
            <td>{{ $movie->title }}</td>
            <td>{{ $movie->plot }}</td>
            <td>{{ $movie->year }}</td>
            <td>{{ $movie->country }}</td>
            <td>{{ $movie->runtime }}</td>
        </tr>
    @endforeach
    </tbody>
</table> 
        
      
</body>
</html>