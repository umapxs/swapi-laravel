<?php

namespace App\Exports;

use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LogsExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return ActivityLog::query();
    }

    public function headings(): array
    {
        return [
            'User',
            'Menu',
            'Action',
            'Browser',
            'Device',
            'Date',
        ];
    }

    public function map($log): array
    {
        return [
            $log->user_id,
            $log->menu,
            $log->action,
            $log->browser,
            $log->device,
            $log->created_at,
        ];
    }
}
