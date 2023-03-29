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
        return view('livewire.peoples-table', [
            'peoples' => People::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }
}
