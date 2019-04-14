<?php

namespace App\Http\Controllers;

use App\Friend;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $friends = Auth::user()->friends();
        return view('chat.friend', compact('users'))->withFriends($friends);
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
    public function addFriend(Request $request)
    {
        //validate
        $user = Auth::user()->id;
        $friends = Friend::where('user_id',$user)->pluck('friend_id');
        foreach ($friends as $friend) {
          if ($friend === $request->friend_id)
          return ('error.addedbefore');
        }

        if ($request->user_id == $request->friend_id) {
            return $response='error.1';
        }

        // Add to database

        $friend = new Friend;
        $friend->user_id = $request->user_id;
        $friend->friend_id = $request->friend_id;
        $friend->save();
                
        Session::flash('success', 'Friend has been added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function removeFriend($id)
    {
        $userId = Auth::user()->id;
        Friend::where([
            ['user_id', $userId],
            ['friend_id', $id]
            ])->delete();
       
        // Session::flash('success', 'Friend has been deleted');
        // return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friend $friend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend $friend)
    {
        //
    }
}
