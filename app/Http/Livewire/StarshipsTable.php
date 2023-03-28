<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Starship;

class StarshipsTable extends Component
{
    public function render()
    {
        return view('livewire.starships-table', [
            'starships' => Starship::all(),
        ]);
    }
}
