<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Services\Client;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()) {
            $user_id = $request->user()->id;
            $reviews = Cache::remember('reviews' . $user_id, 36000, function () use ($user_id) {
                return Review::where('user_id', $user_id)->take(20)->get();
            });
            return view('reviews.reviews')->with('reviews', $reviews);
        } else {
            return redirect()->back();
        }
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
        $headline = $request->input('headline');
        $content = $request->input('content');
        $rating = $request->input('rating');
        $movie_tmdb_id = $request->input('movie_tmdb_id');
        $movie_title = $request->input('movie_title');
        $user_id = $request->user()->id;

        $doesExist = Review::where('user_id', $user_id)->
        where('movie_tmdb_id', $movie_tmdb_id)->exists();

        if (!$doesExist) {
            // store
            $review = new Review;
            $review->headline = $headline;
            $review->content = $content;
            $review->rating = $rating;
            $review->movie_tmdb_id = $movie_tmdb_id;
            $review->movie_title = $movie_title;
            $review->user_id = $user_id;
            $review->save();
            Cache::forget('reviews' . $movie_tmdb_id);
            Cache::forget('reviews' . $user_id);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show($review_id, Request $request, Client $client)
    {
        if (!$request->user()) {
            return redirect('login');
        }
        $user_id = $request->user()->id;
        $movie_tmdb_id = $request->movie_id;
        $review = Review::where('user_id', $user_id)->find($review_id);

        $apikey = env('TMDB_API_KEY', '');

        if ($review) {
            $response = Cache::remember($movie_tmdb_id, 36000, function () use ($client, $apikey, $movie_tmdb_id) {
                $append_videos = "append_to_response=videos";
                $base_url = "https://api.themoviedb.org/3/movie";
                $movie_fetch = $client->get("$base_url/$movie_tmdb_id?api_key=$apikey&$append_videos");
                return json_decode($movie_fetch->getBody());
            });
        
            return view(
                'reviews.review',
                [
                'movie' => $response,
                'review' => $review
                ]
            );
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $user_id = $request->user()->id;
        $review_id = $review->id;

        $toDelete = Review::where(
            'id',
            $review_id
        )->where(
            'user_id',
            $user_id
        )->delete();
    }
}
