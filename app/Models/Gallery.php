<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title_1',
        'title_2',
        'image',
        'description',
        'video_url',
        'ip_address',
        'status',
    ];
}
