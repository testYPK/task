<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function edit()
    {
        $settings = Settings::all();

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Settings::all();

        foreach ($settings as $setting) {
            switch ($setting['key']) {
                case 'path':
                    $setting['value'] = $request->input('path');
                    break;
                case 'file_name_pattern':
                    $setting['value'] = $request->input('file_name_pattern');
                    break;
                case 'load_enabled':
                    $setting['value'] = $request->input('load_enabled');
                    break;
                case 'load_schedule':
                    $setting['value'] = $request->input('load_schedule');
                    break;
            }
            $setting->save();
        }
        return redirect()->route('admin.edit')->with('success', 'Settings have been updated');
    }

}
