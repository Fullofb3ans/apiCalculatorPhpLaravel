<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Calculator extends Model
{
    use HasFactory;
public $timestamps = false;
    protected $fillable = [
        'left_value',
        'right_value',
        'operation',
        'result'
    ];
}
