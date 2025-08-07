<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'ip_address',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Client::class);
    }
}
