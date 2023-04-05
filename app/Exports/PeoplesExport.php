<?php

namespace App\Exports;

use App\Models\People;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeoplesExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return People::query();
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Height',
            'Mass',
            'Hair Color',
            'Skin Color',
            'Eye Color',
            'Birth',
            'Gender',
        ];
    }

    public function map($people): array
    {
        return [
            $people->id,
            $people->name,
            $people->height,
            $people->mass,
            $people->hair_color,
            $people->skin_color,
            $people->eye_color,
            $people->birth_year,
            $people->gender,
        ];
    }
}
