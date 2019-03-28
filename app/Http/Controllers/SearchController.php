<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watchlist;
use App\Review;
use App\Comment;

class SearchController extends Controller
{
    public function index(Request $request)
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

    public function show(Request $request, $id)
    {
        $client = new \GuzzleHttp\Client();

        $apikey = env('TMDB_API_KEY', '');
        
        $movie_fetch = $client->get("https://api.themoviedb.org/3/movie/$id?api_key=$apikey");

        $response = json_decode($movie_fetch->getBody());

        $reviews = Review::where('movie_tmdb_id', $id)->get();
        $comments = Comment::where('movie_tmdb_id', $id)->get();
        $rating = [];
        foreach ($reviews as $review) {
            array_push($rating, $review->rating);
        }
        $tot_rating = (array_sum($rating) / count($reviews));
        if ($request->user()) {
            $user_id = $request->user()->id;
            $watchlists = Watchlist::where('user_id', $user_id)->get();
            return view(
                'movies.movie',
                [
                'movie' => $response,
                'watchlists' => $watchlists,
                'reviews' => $reviews,
                'comments' => $comments,
                'user_id' => $user_id,
                'tot_rating' => $tot_rating,
                ]
            );
        } else {
            return view(
                'movies.movie',
                [
                    'movie' => $response,
                    'watchlists' => null,
                    'reviews' => $reviews,
                    'comments' => $comments,
                    'user_id' => null,
                    'tot_rating' => $tot_rating,
                    ]
            );
        }
    }
}
