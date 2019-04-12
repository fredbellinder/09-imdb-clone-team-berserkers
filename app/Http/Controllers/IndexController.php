<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Services\Client;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }

    public function showMostPopularOfTheYear(Client $client)
    {
        $current_year = date("Y");
        $apikey = env('TMDB_API_KEY', '');
        $popular_fetch = Cache::remember('popular_fetch', 3600, function () use ($current_year, $client) {
            $apikey = env('TMDB_API_KEY', '');
            $discover_base_url = "https://api.themoviedb.org/3/discover/movie";
            $popular_query = "sort_by=popularity.desc&page=1&primary_release_year=$current_year";

            $response = $client->get("$discover_base_url?api_key=$apikey&$popular_query");
            return json_decode($response->getBody());
        });
        
        $movies = array_slice($popular_fetch->results, 0, 5);

        return view('toplists.toplists', [
            'title' => "Hottest of $current_year",
            'list' => $movies
        ]);
    }

    public function showTopHorrorMovies(Client $client)
    {
        $apikey = env('TMDB_API_KEY', '');
        $discover_base_url = "https://api.themoviedb.org/3/discover/movie";
        $horror_query = "sort_by=vote_average.desc&with_genres=27&vote_count.gte=50";

        $horror_fetch = $client->get("$discover_base_url?api_key=$apikey&$horror_query");

        $response = json_decode($horror_fetch->getBody());
        $movies = array_slice($response->results, 0, 5);

        return view('toplists.toplists', [
            'title' => 'Top rated horror movies (international)',
            'list' => $movies
        ]);
    }

    /* Delete this when we go live */
    public function clearCache()
    {
        Cache::flush();
        return redirect()->back();
    }

    public function showTopComedyMovies(Client $client)
    {
        $current_year = date("Y");
        $apikey = env('TMDB_API_KEY', '');
        $discover_base_url = "https://api.themoviedb.org/3/discover/movie";
        $comedy_query = "sort_by=popularity.desc&primary_release_year=$current_year&with_genres=35&vote_count.gte=50";

        $comedy_fetch = $client->get("$discover_base_url?api_key=$apikey&$comedy_query");

        $response = json_decode($comedy_fetch->getBody());
        $movies = array_slice($response->results, 0, 5);

        return view('toplists.toplists', [
            'title' => "The 5 most popular comedies of $current_year",
            'list' => $movies
        ]);
    }
}
