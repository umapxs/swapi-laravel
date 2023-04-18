<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Jenssegers\Agent\Agent;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LogsExport;

class ActivityLogsController extends Controller
{
    public function log($menu, $action)
    {
        /**
         * Information to Log
         *
         *  */

        $log = new ActivityLog;

        $log->user_id = auth()->id();
        $log->menu = $menu;
        $log->action = $action;
        $log->browser = $_SERVER['HTTP_USER_AGENT'];
        $log->device = $this->getDeviceType();

        $log->save();
    }

    private function getDeviceType()
    {
        $agent = new \Jenssegers\Agent\Agent;

        switch (true) {
            case $agent->isDesktop():
                return 'desktop';
                break;
            case $agent->isMobile():
                return 'mobile';
                break;
            default:
                return 'unknown';
        }
    }

    public function index()
    {
        // $logs = ActivityLog::orderBy('created_at', 'desc')->paginate(10);
        // return view('activity_logs.index', compact('logs'));
        return view('tables.log-table');
    }

    public function export()
    {
        return Excel::download(new LogsExport, 'logs.xlsx');
    }
}
