<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Contracts\View\View;

class LogController extends Controller
{
    public function showLogList(): View
    {
        $logs = Log::all();

        return view('logs.logList', ['logs' => $logs]);
    }
}
