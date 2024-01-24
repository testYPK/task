<?php

namespace App\Http\Controllers;

use App\Models\Log;

class LogController extends Controller
{
    public function showLogList()
    {
        $logs = Log::all();

        return view('logs.logList', ['logs' => $logs]);
    }
}
