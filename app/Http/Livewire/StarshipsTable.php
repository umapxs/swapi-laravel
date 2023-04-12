<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Starship;
use Livewire\WithPagination;

class StarshipsTable extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public function render()
    {
        $starships = Starship::query()
            ->when($this->search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        return view('livewire.starships-table', compact('starships'))->extends('layouts.app');
    }
}
