<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <h1>TEST</h1>
    
    <table class="table table-dark">
        <thead>
            <tr>
            <th>Id</th>
            <th>title</th>
            <th>plot</th>
            <th>year</th>
            <th>country</th>
            <th>runTime</th>
            <th>directors</th>
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
           <?php $directors = $movie->directors ?> 
           <td>
               @foreach($directors as $director)        
                {{ $director->first_name }}
                {{ $director->last_name }}
                @endforeach

           </td>
        
        </tr>
        @endforeach
    </tbody>
</table> 

</body>
</html>

{{-- 
    
<table class="table table-dark">
    <thead>
        <tr>
            <th>Movie</th>
            <th>Id</th>
            <th>title</th>
            <th>plot</th>
            <th>year</th>
            <th>country</th>
            <th>runTime</th>
        </tr>
    </thead>

    <tbody> @foreach($directors as $director) 
        <tr>
            <td>{{ $director->id }}</td>
            <td>{{ $director->id }}</td>
            <td>{{ $director->first_name }}</td>
            <td>{{ $director->last_name }}</td>
            <td>{{ $director->bio }}</td>
            <td>{{ $director->age }}</td>
            <td>{{ $director->gender }}</td>
        </tr>
    @endforeach
    </tbody>
</table>   --}}

        