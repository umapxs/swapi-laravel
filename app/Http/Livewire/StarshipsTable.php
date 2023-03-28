<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Starship;
use Livewire\WithPagination;

class StarshipsTable extends Component
{
    public $perPage = 5;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public function render()
    {
        return view('livewire.starships-table', [
            'starships' => Starship::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }
}
