<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locality extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'locality_name',
    ];

    public function districts(): HasMany
    {
        return $this->hasMany(District
        ::class);
    }

    public function churches(): HasMany
    {
        return $this->hasMany(Church::class);
    }
}
