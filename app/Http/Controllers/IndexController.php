<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Client;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }

    public function showMostPopularOfTheYear(Client $client)
    {
        $apikey = env('TMDB_API_KEY', '');
        $current_year = date("Y");
        
        $popular_fetch = $client->get("https://api.themoviedb.org/3/discover/movie?api_key=$apikey&sort_by=popularity.desc&page=1&primary_release_year=$current_year");
        
        $response = json_decode($popular_fetch->getBody());

        $movies = array_slice($response->results, 0, 5);

        return view('toplists.toplists', [
            'title' => "Hottest of $current_year",
            'list' => $movies
        ]);
    }

    public function showTopHorrorMovies(Client $client)
    {
        $apikey = env('TMDB_API_KEY', '');

        $horror_fetch = $client->get("https://api.themoviedb.org/3/discover/movie?api_key=$apikey&sort_by=vote_average.desc&with_genres=27&vote_count.gte=50");

        $response = json_decode($horror_fetch->getBody());
        $movies = array_slice($response->results, 0, 5);

        return view('toplists.toplists', [
            'title' => 'Top rated horror movies',
            'list' => $movies
        ]);
    }
}
