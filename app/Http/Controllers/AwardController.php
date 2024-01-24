<?php

namespace App\Http\Controllers;

use App\Models\Award;

class AwardController extends Controller
{
    public function showAwardList()
    {
        $awards = Award::all();
        return view('awards.awardsList', ['awards' => $awards]);
    }
}
