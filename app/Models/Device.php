<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['firebase_token','platform'];
    const DEVICES = [
        'ios', 'android'
    ];
    use HasFactory;
}
