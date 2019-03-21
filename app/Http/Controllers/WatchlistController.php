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

    public function index()
    {
        $watchlist = Watchlist::all()->paginate(1);
        return view('list')->with('list', $watchlist);
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
        $data = [
            'title' => 'Rambo',
            'poster_url' => "https://image.tmdb.org/t/p/w185_and_h278_bestv2/bbYNNEGLXrV3lJpHDg7CKaPscCb.jpg",
            'id' => 5039
        ];
        
        $watchlist = Watchlist::where('user_id', 1)->find(1);
        dd($watchlist);


        return $watchlist;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Watchlist  $watchlist
     * @return \Illuminate\Http\Response
     */
    public function show($watchlist)
    {
        $watchlist = Watchlist::find($watchlist);
        if ($watchlist) {
            $list_items = (array) $watchlist->list_items; // typecasting
            return view('list', [
                'list' => $list_items]);
        } else {
            return view('list', [
                'list' => []
                ]);
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
