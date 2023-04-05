<?php

namespace App\Exports;

use App\Models\Film;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FilmsExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return Film::query();
    }

    public function headings(): array
    {
        return [
            '#',
            'Title',
            'Episode',
            'Director/s',
            'Producer/s',
            'Release Date',
        ];
    }

    public function map($film): array
    {
        return [
            $film->id,
            $film->title,
            $film->episode_id,
            $film->director,
            $film->producer,
            $film->release_date,
        ];
    }
}
