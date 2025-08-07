<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'image',
        'phone',
        'email',
        'ip_address',
        'status',
        'twitter_link',
        'facebook_link',
        'linkedin_link',
    ];
}