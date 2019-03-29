@extends('layouts.master') 
@section('content')
<div class="container bg-light mt-2">
  <form class="p-4" method="GET" action="/advanced-search">
    <div class="form-row">
      <div class="col">
          <select name="lang" class="custom-select">
              <option selected value="">Select a language</option>
              @foreach($lang as $lng)
              <option value="{{$lng->iso_639_1}}">{{ $lng->english_name }}</option>
              @endforeach
            </select>
      </div>
      <div class="col">
          <select name="year" class="custom-select">
            <option selected value="">Select a release year</option>
              @for ($i = date("Y"); $i >= 1950; $i--)
              <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>     
      </div>
      <div class="col">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </div>
    </div>
    <div class="row">
      <div class="col s6 m12 l12 py-2">
        @foreach ($genres as $genre)
        <div class="form-check form-check-inline">
          <input name="genre[]" class="form-check-input" type="checkbox" id="{{ $genre['id'] }}" value="{{ $genre['id'] }}">
          <label class="form-check-label" for="{{ $genre['id'] }}">{{ $genre['name'] }}</label>
        </div>
        @endforeach
      </div>
    </div>
  </form>
</div>
@endsection