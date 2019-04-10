<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Watchlist;
use App\Review;
use App\Comment;
use App\Services\Client;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $user_name = $request->user()->name;
        $watchlists = Watchlist::where('user_id', $user_id)->get();
        $reviews = Review::where('user_id', $user_id)->get();
        $comments = Comment::where('user_id', $user_id)->get();

        return view('users.dashboard', [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'watchlists' => $watchlists,
            'reviews' => $reviews,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Client $client, $id)
    {
        $apikey = env('TMDB_API_KEY', '');
        $append_videos = "append_to_response=videos";


        if (Cache::has("$id")) {
            $movie = Cache::get("$id");
        } else {
            $movie_fetch = $client->get("https://api.themoviedb.org/3/movie/$id?api_key=$apikey&$append_videos");
            $movie = json_decode($movie_fetch->getBody());
            Cache::put("$id", $movie, 36000);
        }
        
        if ($movie->videos->results) {
            $trailers_array = array();
            $teasers_array = array();
            foreach ($movie->videos as $result) {
                foreach ($result as $video) {
                    if ($video->site == "YouTube" && $video->type == "Trailer") {
                        array_push($trailers_array, $video);
                    } elseif ($video->site == "YouTube" && $video->type == "Teaser") {
                        array_push($teasers_array, $video);
                    }
                }
            }
            // dd($trailers_array[0], $teasers_array[0]);
        }

        $reviews = Review::where('movie_tmdb_id', $id)->get();
        $approvedReviews = Review::where('movie_tmdb_id', $id)->where('approved', 1)->get();
        $comments = Comment::where('movie_tmdb_id', $id)->get();
        $rating = [];
        $tot_rating = '';
        if (count($approvedReviews) > 0) {
            foreach ($approvedReviews as $review) {
                array_push($rating, $review->rating);
            }
            $tot_rating = round(
                (array_sum($rating) / 5) / count($approvedReviews),
                1,
                PHP_ROUND_HALF_UP
            ) * 50;
        }
        if ($request->user()) {
            $user_id = $request->user()->id;
            $watchlists = Watchlist::where('user_id', $user_id)->get();
            return view(
                'movies.movie',
                [
                  'movie' => $movie,
                  'trailers' => $trailers_array,
                  'teasers' => $teasers_array,
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
                  'movie' => $movie,
                  'trailers' => $trailers_array,
                  'teasers' => $teasers_array,
                  'watchlists' => null,
                  'reviews' => $reviews,
                  'comments' => $comments,
                  'user_id' => null,
                  'tot_rating' => $tot_rating,
                ]
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
