<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    const STATUS_SUCCESS = 'Success';
    const STATUS_FAIL = 'Fail';

    protected $fillable = [
        'file_path',
        'status',
        'records_added'
    ];
}
