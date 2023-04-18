<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ActivityLog;
use Livewire\WithPagination;

class LogsTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'created_at';
    public $orderAsc = false;

    public function render()
    {
        $logs = ActivityLog::query()
            ->when($this->search, function ($query, $search) {
                return $query->where('menu', 'like', '%' . $search . '%')
                    ->orWhere('action', 'like', '%' . $search . '%');
            })
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return view('livewire.logs-table', compact('logs'))->extends('layouts.app');
    }
}
