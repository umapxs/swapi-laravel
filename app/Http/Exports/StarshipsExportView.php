<?php

namespace App\Exports;

use App\Starship;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StarshipsExportView implements FromView
{
    public function view(): View
    {
        return view('livewire.starships-table', [
            'starships' => Starship::all()
        ]);
    }
}