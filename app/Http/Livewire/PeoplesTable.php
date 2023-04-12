<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\People;
use Livewire\WithPagination;

class PeoplesTable extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public function render()
    {
        $peoples = People::query()
            ->when($this->search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        return view('livewire.peoples-table', compact('peoples'))->extends('layouts.app');
    }
}
