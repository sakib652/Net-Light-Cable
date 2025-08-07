<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_name',
        'area_id',
        'owner_name',
        'phone',
        'address',
        'ip_address',
        'status',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
