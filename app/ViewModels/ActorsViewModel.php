<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public $popularActors;
    public $page;
    public function __construct($popularActors, $page)
    {
        $this->popularActors = $popularActors;
        $this->page = $page;
    }




    public function popularActors(){
        return $this->formattedActors($this->popularActors);
    }

    public function knowFor($known_for){
        return collect($known_for)->mapWithKeys(function ($knownFor){
            dd($knownFor);
            return [$knownFor['id'] => $knownFor['original_title']];
        });
    }

    public function formattedActors($actors){

        return collect($actors)->map(function($actor){
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path'] ?
                    'https://image.tmdb.org/t/p/w235_and_h235_face' . $actor['profile_path']
                    : 'https://via.placeholder.com/235x235',
                'known_for' => collect($actor['known_for'])->where('media_type', 'movie')->pluck('original_title')->union(
                collect($actor['known_for'])->pluck('name'))->implode(', '),
            ])
            ->only([
                'profile_path', 'id', 'name', 'known_for'
            ]);
        });
    }

    public function previous(){
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next(){
        return $this->page < 500 ? $this->page + 1 : null;
    }
}
