<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_slider',
        'main_mobile_slider',
        'disable_filters',
        'callback_email',
    ];
    protected $casts = [
        'main_slider' => 'array',
        'main_mobile_slider' => 'array',
        'disable_filters' => 'array',
    ];
}
