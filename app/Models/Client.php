<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'card_code'
    ];

    public function cash()
    {
        return $this->hasMany(Cash::class, "clientId", "id");
    }
}
