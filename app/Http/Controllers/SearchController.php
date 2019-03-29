<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watchlist;
use App\Review;
use App\Comment;

class SearchController extends Controller
{
    public function view()
    {
        $client = new \GuzzleHttp\Client();
    
        $apikey = env('TMDB_API_KEY', '');

        $baseURL= "https://api.themoviedb.org/3/configuration";
        $movie_fetch = $client->get("$baseURL/languages?api_key=$apikey");
        
        $languages = json_decode($movie_fetch->getBody());
      
        $genres = [
          [
            "id" => 28,
            "name" =>"Action"
          ],
          [
            "id" => 12,
            "name" => "Adventure"
          ],
          [
            "id" => 16,
            "name" => "Animation"
          ],
          [
            "id" => 35,
            "name" => "Comedy"
          ],
          [
            "id" => 80,
            "name" => "Crime"
          ],
          [
            "id" => 99,
            "name" => "Documentary"
          ],
          [
            "id" => 18,
            "name" => "Drama"
          ],
          [
            "id" => 10751,
            "name" => "Family"
          ],
          [
            "id" => 14,
            "name" => "Fantasy"
          ],
          [
            "id" => 36,
            "name" => "History"
          ],
          [
            "id" => 27,
            "name" => "Horror"
          ],
          [
            "id" => 10402,
            "name" => "Music"
          ],
          [
            "id" => 9648,
            "name" => "Mystery"
          ],
          [
            "id" => 10749,
            "name" => "Romance"
          ],
          [
            "id" => 878,
            "name" => "Science Fiction"
          ],
          [
            "id" => 10770,
            "name" => "TV Movie"
          ],
          [
            "id" => 53,
            "name" => "Thriller"
          ],
          [
            "id" => 10752,
            "name" => "War"
          ],
          [
            "id" => 37,
            "name" => "Western"
          ]
          ];
    
        return view(
            'search.advanced_search',
            [
            'genres' => $genres,
            'lang' => $languages,
            ]
        );
    }

    public function search(Request $request)
    {
        $query=($request->input('query'));
        $queryParam = urlencode($query);

        $client = new \GuzzleHttp\Client();

        $apikey = env('TMDB_API_KEY', '');

        $baseURL= "https://api.themoviedb.org/3/search";
        $movie_fetch = $client->get("$baseURL/movie?api_key=$apikey&query=$queryParam");

        $response = json_decode($movie_fetch->getBody());
        
        if (empty($response->results)) {
            return redirect()->back()->withErrors(['No matches for search query']);
        } else {
            return view(
                'movies.movies',
                [
                'results' => $response->results
                ]
            );
        }
    }

    public function advancedSearch(Request $request)
    {
        if (!array_filter($request->input())) {
            return redirect()->back()->withErrors(['All fields empty']);
        }

        $client = new \GuzzleHttp\Client();
    
        $apikey = env('TMDB_API_KEY', '');
        
        $urlQuery = "sort_by=popularity.desc&page=1";
        
        if ($request->input('lang') !== null) {
            $urlQuery = $urlQuery."&with_original_language=".$request->input('lang');
        }

        if ($request->input('year') !== null) {
            $urlQuery = $urlQuery."&primary_release_year=".$request->input('year');
        }

        if ($request->input('genre') !== null) {
            $genreString = implode(",", $request->input('genre'));
            $urlQuery = $urlQuery."&with_genres=".$genreString;
        }
        
        $baseURL= "https://api.themoviedb.org/3/discover";
        $movie_fetch = $client->get("$baseURL/movie?api_key=$apikey&$urlQuery");

        $response = json_decode($movie_fetch->getBody());
        
        if (empty($response->results)) {
            return redirect()->back()->withErrors(['No matches found']);
        } else {
            return view(
                'movies.movies',
                [
                  'results' => $response->results
                ]
            );
        }
    }
}
