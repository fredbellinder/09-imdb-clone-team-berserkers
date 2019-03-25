<?php

namespace App\Http\Controllers;

use App\Watchlist;
use App\User;

use Illuminate\Http\Request;

class WatchlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $watchlists = Watchlist::where('user_id', $user_id)->take(20)->get();

        return view('lists.lists')->with('list', $watchlists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $watchlist = new Watchlist;
        $watchlist->title = $request->input('title');
        $watchlist->user_id = $request->user()->id;
        $watchlist->list_items = [];
        $watchlist->save();

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $listId = $request->input('list_id');
        $poster_url = $request->input('poster_url');
        $title = $request->input('title');
        $movie_id = $request->input('movie_id');
        $user_id = $request->user()->id;

        $watchlist = Watchlist::where('user_id', $user_id)->get();

        if ($watchlist) {
            $pushable_array = (array) $watchlist->list_items;
            $to_push = ["poster_url" => $poster_url,
            "title" => $title,
            "id" => $movie_id];
            
            array_push($pushable_array, $to_push);
            $to_push = [];
            
            $watchlist->list_items = $pushable_array;
            
            
            $watchlist->save();
            return redirect()->route('movies.show', ['movie' => $movie_id]);
        } else {
            echo 'WATCHLIST DON\'T NO EXIST';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Watchlist  $watchlist
     * @return \Illuminate\Http\Response
     */
    public function show($list_id, Request $request)
    {
        $user_id = $request->user()->id;
        $watchlist = Watchlist::where('user_id', $user_id)->find($list_id);
        if ($watchlist) {
            $list_items = (array) $watchlist->list_items; // typecasting
            return view(
                'lists.list',
                [
                'list' => $list_items]
            );
        } else {
            return view(
                'lists.list',
                [
                'list' => []
                ]
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Watchlist  $watchlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Watchlist $watchlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Watchlist  $watchlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Watchlist $watchlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Watchlist  $watchlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Watchlist $watchlist)
    {
        //
    }
}
