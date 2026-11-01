<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Church extends Model
{
    protected $fillable = [
        'church_code',
        'church_name',
        'type',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
}
