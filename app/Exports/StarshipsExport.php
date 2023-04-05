<?php

namespace App\Exports;

use App\Models\Starship;
use Maatwebsite\Excel\Concerns\FromCollection;

class StarshipsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Starship::all();
    }
}
