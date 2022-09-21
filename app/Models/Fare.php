<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    use HasFactory;

    public $fillable = [
        'value',
        'status',
        'operator_id'
    ];

    public const STATUS_ENUM = [
        'active' => 1,
        'inactive' => 2,
    ];

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function active()
    {
        return $this->status == Fare::STATUS_ENUM['active'];
    }

    public function getStatusString()
    {
        switch ($this->status) {
            case Fare::STATUS_ENUM['active']:
                return 'ativa';
                break;
            case Fare::STATUS_ENUM['inactive']:
                return 'inativa';
                break;
        }
    }
}
