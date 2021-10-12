<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    use HasFactory;

    protected $fillable = [
        'cash',
        'clientId'
    ];

    public function client()
    {
        return $this->hasOne(Client::class, "id", "clientId");
    }
}
