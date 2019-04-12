@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 offset-2 mb-5">
            <div class="card bm-5">
                <div class="card-header text-white bg-dark lead">
                    List of all Users
                </div>

                @forelse($users as $user)
                        <div class="text-dark lead text-capitalize px-3 py-2">
                        <span>
                           {{ $user->name }} <addfriend v-bind:userid="{{ $user->id }}"
                            v-bind:myid="{{ Auth::user()->id }}"
                            ></addfriend>
                        </span>
                        </div>

                    @empty
                        <div class="card-footer text-danger">
                            There is not Users!!!
                        </div>

                    @endforelse

            </div>
        </div>

            <div class="col-md-8 offset-2">
                <div class="card">
                    <div class="card-header text-white bg-success lead">
                        List of your friends
                    </div>

                    @forelse($friends as $friend)
                        <div class="text-dark lead text-capitalize  px-3 py-2">
                            <span class="">
                               {{ $friend->name }}<removefriend v-bind:friendid="{{ $friend->id }}"
                                v-bind:myid="{{ Auth::user()->id }}"
                                ></removefriend>
                           </span>
                        </div>


                    @empty
                        <div class="card-footer text-danger">
                            You don't have any friends
                        </div>
                    @endforelse
                </div>
        </div>

@endsection
