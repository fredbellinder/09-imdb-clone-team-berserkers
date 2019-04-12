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
        return redirect('users');
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
            $movie_fetch = $client->get("https://api.themoviedb.org/3/movie/$id?api_key=$apikey&append_to_response=credits%2Cvideos");
            $movie = json_decode($movie_fetch->getBody());
            Cache::put("$id", $movie, 36000);
        }
        $cast_array = array();
        $crew_array = array();
        $trailers_array = array();
        $teasers_array = array();
        
        for ($i = 0; $i < 6; $i++) {
            array_push($cast_array, $movie->credits->cast[$i]);
            array_push($crew_array, $movie->credits->crew[$i]);
        }

        if ($movie->videos->results) {
            foreach ($movie->videos as $result) {
                foreach ($result as $video) {
                    if ($video->site == "YouTube" && $video->type == "Trailer") {
                        array_push($trailers_array, $video);
                    } elseif ($video->site == "YouTube" && $video->type == "Teaser") {
                        array_push($teasers_array, $video);
                    }
                }
            }
        }

        $approved_reviews = Cache::remember('approved_reviews' . $id, 36000, function () use ($id) {
            return Review::where('movie_tmdb_id', $id)->where('approved', 1)->get();
        });

        $approved_comments = Cache::remember('approved_comments' . $id, 36000, function () use ($id) {
            return Comment::where('movie_tmdb_id', $id)->where('approved', 1)->get();
        });
    
        $rating = [];
        $tot_rating = '';
        if (count($approved_reviews) > 0) {
            foreach ($approved_reviews as $review) {
                array_push($rating, $review->rating);
            }
            $tot_rating = round(
                (array_sum($rating) / 5) / count($approved_reviews),
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
                  'reviews' => $approved_reviews,
                  'comments' => $approved_comments,
                  'user_id' => $user_id,
                  'tot_rating' => $tot_rating,
                  'cast' => $cast_array,
                  'crew' => $crew_array
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
                  'reviews' => $approved_reviews,
                  'comments' => $approved_comments,
                  'user_id' => null,
                  'tot_rating' => $tot_rating,
                  'cast' => $cast_array,
                  'crew' => $crew_array
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
