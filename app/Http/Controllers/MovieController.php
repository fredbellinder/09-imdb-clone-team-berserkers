<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watchlist;
use App\Review;
use App\Comment;

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
    public function show(Request $request, $id)
    {
        $client = new \GuzzleHttp\Client();

        $apikey = env('TMDB_API_KEY', '');
        
        $movie_fetch = $client->get("https://api.themoviedb.org/3/movie/$id?api_key=$apikey");

        $response = json_decode($movie_fetch->getBody());

        $reviews = Review::where('movie_tmdb_id', $id)->get();
        $comments = Comment::where('movie_tmdb_id', $id)->get();
        $rating = [];
        $tot_rating = '';
        if (count($reviews) > 0) {
            foreach ($reviews as $review) {
                array_push($rating, $review->rating);
            }
            $tot_rating = floor((array_sum($rating) / count($reviews)));
            // Ska vi ha halva poäng så kör vi på denna:
            // Bilderna behövs då istället för att namnges, 1 2 3 4 5,
            // namnges, 10 15 20 25 30 35 40 45 0ch 50
            // $tot_rating = round(
            //     (array_sum($rating) / 5) / count($reviews),
            //     1,
            //     PHP_ROUND_HALF_UP
            // ) * 50;
        }
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
