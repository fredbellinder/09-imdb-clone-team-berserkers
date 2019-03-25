<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watchlist;

class TmdbController extends Controller
{
    public function index(Request $request)
    {
        $query=($request->input('query'));
        
        $queryParam = urlencode($query);
        
        $client = new \GuzzleHttp\Client();
    
        $apikey = env('TMDB_API_KEY', '');
    
        $request = $client->get("https://api.themoviedb.org/3/search/movie?api_key=$apikey&query=$queryParam");

        $response = json_decode($request->getBody());

        
        return view('movies.movies', [
            'results' => $response->results
        ]);
    }

    public function show(Request $request, $id)
    {
        $client = new \GuzzleHttp\Client();

        $apikey = env('TMDB_API_KEY', '');

        $user_id = $request->user()->id;


        $request = $client->get("https://api.themoviedb.org/3/movie/$id?api_key=$apikey");

        $response = json_decode($request->getBody());


        $watchlists = Watchlist::where('user_id', $user_id)->get();

        return view('movies.movie', [
            'movie' => $response,
            'watchlists' => $watchlists,

        ]);
    }
}
