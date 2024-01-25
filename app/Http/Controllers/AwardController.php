<?php

namespace App\Http\Controllers;

use App\Models\Award;
use Illuminate\Contracts\View\View;

class AwardController extends Controller
{
    public function showAwardList(): View
    {
        $awards = Award::all();
        return view('awards.awardsList', ['awards' => $awards]);
    }
}
