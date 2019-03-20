<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Watchlist;


class TmdbController extends Controller
{
    public function fetchMovie($id)
    {
        $client = new \GuzzleHttp\Client();

        $apikey = env('TMDB_API_KEY', '');

        $request = $client->get("https://api.themoviedb.org/3/movie/$id?api_key=$apikey");

        $response = json_decode($request->getBody());

        return view('movie', [
            'movie' => $response
        ]);
    }


}
