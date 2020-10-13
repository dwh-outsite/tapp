<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventShift extends Model
{
    use HasFactory;

    public const DEFAULT_NUMBER_OF_BARTENDERS = 2;

    protected $guarded = [];

    protected $casts = [
        'bartenders' => 'integer'
    ];
}
