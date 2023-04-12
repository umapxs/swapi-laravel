<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Film;
use Livewire\WithPagination;

class FilmsTable extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    // public function render()
    // {
    //     return view('livewire.films-table', [
    //         'films' => Film::search($this->search)
    //             ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
    //             ->simplePaginate($this->perPage),
    //     ]);
    // }
    public function render()
    {
        $films = Film::query()
            ->when($this->search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        return view('livewire.films-table', compact('films'))->extends('layouts.app');
    }
}
