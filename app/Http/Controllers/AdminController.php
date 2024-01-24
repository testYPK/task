<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function edit()
    {
        $settings = Settings::first();

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Settings::first();

        if (!$settings) {
            $settings = new Settings;
        }

        $settings->path = $request->input('file_path_template');
        $settings->file_name_pattern = $request->input('file_name_template');
        $settings->load_schedule = $request->input('load_schedule_template');
        $settings->load_enabled = $request->has('load_enabled');

        $settings->save();

        return redirect()->route('admin.edit')->with('success', 'Settings have been updated');
    }

}
