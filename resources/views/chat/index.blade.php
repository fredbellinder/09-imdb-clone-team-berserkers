@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header text-white bg-dark lead">
                    List of all Friends
                </div>
                @forelse($friends as $friend)
                    <a href="{{ route('chat.show', $friend->id) }}" class="card-body bg-light text-decoration-none">
                       <span class="text-dark lead text-capitalize">
                           {{ $friend->name }}
                       </span>
                        <onlineuser v-bind:friend="{{ $friend }}"
                        v-bind:onlineusers="onlineUsers">
                        </onlineuser>
                    </a>
                    @empty
                    <div class="card-footer text-danger">
                        You don't have any friends
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
