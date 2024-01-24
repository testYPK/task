<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    public static array $validationRules = [
        'year' => 'required|integer|min:1900',
        'age' => 'required|integer|min:3|max:99',
        'name' => 'required|string|max:255',
        'movie' => 'required|string|max:255',
    ];

    protected $fillable = [
        'year',
        'age',
        'name',
        'movie'
    ];
}
