<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watchlist;
use App\Review;
use App\Comment;

class SearchController extends Controller
{
    public function view()
    {
        $genres = [
            "Action",
            "Adventure",
            "Animation",
            "Comedy",
            "Crime",
            "Documentary",
            "Drama",
            "Family",
            "Fantasy",
            "History",
            "Horror",
            "Music",
            "Mystery",
            "Romance",
            "Science Fiction",
            "TV Movie",
        ];
        return view(
            'search.advanced_search',
            [
            'genres' => $genres
            ]
        );
    }

    public function search(Request $request)
    {
        $query=($request->input('query'));
        
        $queryParam = urlencode($query);
        
        $client = new \GuzzleHttp\Client();
    
        $apikey = env('TMDB_API_KEY', '');
    
        $movie_fetch = $client->get("https://api.themoviedb.org/3/search/movie?api_key=$apikey&query=$queryParam");

        $response = json_decode($movie_fetch->getBody());

        
        return view(
            'movies.movies',
            [
            'results' => $response->results
            ]
        );
    }

    public function advancedSearch(Request $request)
    {
        $query=($request->input('query'));
        
        $queryParam = urlencode($query);
        
        $client = new \GuzzleHttp\Client();
    
        $apikey = env('TMDB_API_KEY', '');
    
        $movie_fetch = $client->get("https://api.themoviedb.org/3/search/movie?api_key=$apikey&query=$queryParam");

        $response = json_decode($movie_fetch->getBody());

        return view(
            'movies.movies',
            [
            'results' => $response->results
            ]
        );
    }
}
