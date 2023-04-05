<?php

namespace App\Exports;

use App\Models\Starship;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StarshipsExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return Starship::query();
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Model',
            'Manufacturer',
            'M. Speed',
            'Crew',
            'Passengers',
            'Class',
            'Pilots',
            'Films',
        ];
    }

    public function map($starship): array
    {
        return [
            $starship->id,
            $starship->name,
            $starship->model,
            $starship->manufacturer,
            $starship->max_atmosphering_speed,
            $starship->crew,
            $starship->passengers,
            $starship->starship_class,
            str_replace('"', '', $starship->pilots),
            str_replace('"', '', $starship->films),
        ];
    }
}
