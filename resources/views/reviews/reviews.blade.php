@extends('layouts.master') 
@section('content')

<div class="container">
@foreach ($reviews as $review)
  <h1>{{ $review->movie_title }}</h1>
    <div class="row">
      <div class="col-6 p-3">
        <h3 class="card-text">{{ $review->headline }}</h3>
        <p class="card-text">{{ $review->content }}</p>
        <div class="mb-3">
            @if($review->rating === null)
        <img src="{{ asset('assets/null.svg') }}" /> @else
        <img src="{{ asset('assets/'.($review->rating*10).'.svg') }}" /> @endif
        </div>
        @if (!$review->approved)
          <h4>Review is pending approval by a moderator.</h4>
          <p>Until it is approved, only you will be able to see it.</p>
        @endif
      </div>
    </div>
@endforeach
</div>

@endsection