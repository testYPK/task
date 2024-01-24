<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function indexPage()
    {
        $template = config('fileNamePattern.template', 'csv_award' . time());
        return view('admin.settings', ['template' => $template]);
    }

}
