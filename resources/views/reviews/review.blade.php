@extends('layouts.master') 
@section('content')

<div class="container py-3 my-3  ">
  <div class="row">
    <header class="col-12 text-center mb-2">
      <a class="text-dark" href="/movies/{{ $movie->id}}">
        <h1>{{ $review->movie_title }} ({{ $movie->release_date }}) </h1>
      </a>
        <header>
  </div>
  <div class="row">
    <section class="col-12 col-sm-6 text-center">
      <h3>{{$review->headline}}</h3>
      <p>{{$review->content}}</p>
      <div class="mb-3">
        @if($review->rating === null)
        <img src="{{ asset('assets/null.svg') }}" /> @else
        <img src="{{ asset('assets/'.($review->rating*10).'.svg') }}" /> @endif
      </div>
      @if (!$review->approved)
      <p class="p-2 bg-danger text-light text-center">This review is pending approval by a moderator. Until it is approved, only you will be able to see it.</p>
      @else
      <p class="p-2 bg-success text-light text-center">This review has been approved by a moderator and is visible.</p>
      @endif
    </section>
    <section class="col-12 col-sm-6 text-center">
      <a href="/movies/{{ $movie->id}}">
        @if($movie->poster_path !== null)
        <img src="http://image.tmdb.org/t/p/w300//{{$movie->poster_path}}" alt="{{$movie->title}}">
        @else
        <img class="card-img-top" src="https://via.placeholder.com/300x150.png?text=No+Poster+Available" alt="{{$movie->title}}"/>
        @endif
        </a>
    </section>
  </div>
  {{-- <div class="card-body edit-review-container-{{$review->id}}" style="display:none"> --}}
  <div class="card-body edit-review-container-{{$review->id}}">
      
      <form method="POST" action="/reviews/{{$review->id}}">
        @csrf @method('PATCH')
        <input type="hidden" name="movie_tmdb_id" value="{{$movie->id}}">
        <input type="hidden" name="review_id" value="{{$review->id}}">
        <input type="hidden" name="movie_title" value="{{$movie->title}}">
        <div class="row my-2">
          <label class="px-2" for="headline">Headline</label>
          <input type="text" class="form-control mx-3" name="headline" value="{{$review->headline}}" required/>
        </div>
        <div class="row my-2">
          <label class="px-2" for="headline">Content</label>
          <textarea name="content" class="form-control mx-3" rows="5" value="{{$review->content}}" required>{{$review->content}}</textarea>
        </div>
        <select class="form-control mx-auto" name="rating" required>
              <option selected disabled>New Rating</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
        <button class="btn btn-danger mt-2 edit-submit-{{$review->id}}" type="submit">Submit</button>
        <button class="btn btn-danger mt-2 edit-review-cancel">Cancel</button>
      </form>
    </div>
    <script>

        const editReviewForm = $('.edit-review');
        function editReview(event) {
          event.preventDefault();
          const review_id=(event.target[1].value);
          const reviewInfo = $(this).closest('.container-review');
            const editReview = $(`.edit-review-container-${review_id}`);
          editReview.show();
          reviewInfo.hide();
          
          $(`.edit-submit-${review_id}`).on('submit', function(event, reviewInfo) {
            event.preventDefault();
            $(`.edit-review-container-${review_id}`).hide();
            editReview.hide();
            reviewInfo.show();
            
          });
          $(`.edit-review-cancel`).on('click', function(event) {
            event.preventDefault();
            $(`.edit-review-container-${review_id}`).hide();
            reviewInfo.show();
          });
        }
        editReviewForm.on("submit", editReview);
@endsection