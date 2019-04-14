@extends('layouts.app')

@section('content')
    <audio id="ChatAudio">
       <source src="{{ asset('sounds/chat.mp3') }}">
    </audio>
    <meta name="friendId" content="{{ $friend->id }}">
    <div class="container" style="display: flex; justify-content:center">
        <div class="col-md-8">
            <div class="card bg-dark text-white">
                <div class="card-header lead">
                {{ $friend->name }}
                    <div class="contain float-right">
                    <a href="{{ url('/chat') }}" class="item-link">
                        <i class="fa fa-arrow-left"></i>
                        Go Back
                        </a>
                    </div>
                <chat v-bind:chats="chats" v-bind:userid="{{ Auth::user()->id }}"
                v-bind:friendid="{{ $friend->id }}"
                >
                </chat>
                </div>
            </div>
        </div>
    </div>
@endsection
