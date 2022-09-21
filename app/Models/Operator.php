<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;

    public $fillable = [
        'code',
    ];

    public function fares()
    {
        return $this->hasMany(Fare::class);
    }
}
