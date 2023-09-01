<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTv;
    public $topRatedTv;
    public $genres;

    public function __construct($popularTv, $topRatedTv, $genres)
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;

    }

    public function popularTv(){
        return $this->formattedTv($this->popularTv['results']);
    }

    public function topRatedTv(){
        return $this->formattedTv($this->topRatedTv['results']);
    }

    public function genres(){
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    public function formattedTv($tv){

        return collect($tv)->map(function($tv){
            $genresFormatted = collect($tv['genre_ids'])->mapWithKeys(function ($genre){
                return [$genre => $this->genres()->get($genre)];
            })->implode(', ');

            return collect($tv)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $tv['poster_path'],
                'first_air_date' => \Carbon\Carbon::parse($tv['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'name', 'vote_average','genres', 'overview', 'genre_ids','first_air_date'
            ]);
        });

    }
}
