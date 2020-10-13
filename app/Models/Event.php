<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['starts_at'];

    public function shifts()
    {
        return $this->hasMany(EventShift::class);
    }
}
