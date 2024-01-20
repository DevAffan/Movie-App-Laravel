<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlayingMovies;
    public $genres;

    public function __construct($popularMovies, $nowPlayingMovies, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genres;

    }

    public function popularMovies(){
        return $this->formattedMovies($this->popularMovies['results']);
    }

    public function nowPlayingMovies(){
        return $this->formattedMovies($this->nowPlayingMovies['results']);
    }

    public function genres(){
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    public function formattedMovies($movie){

        return collect($movie)->map(function($movie){
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($genre){
                return [$genre => $this->genres()->get($genre)];
            })->implode(', ');
            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'],
                // 'vote_average' => $movie['vote_average'] * 10 . '%',
                'release_date' => \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'original_title', 'vote_average', 'release_date', 'genres', 'overview', 'genre_ids'
            ]);
        });
    }
}
