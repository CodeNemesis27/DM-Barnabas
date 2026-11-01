<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'phone_no',
        'address',
        'church_id',
    ];

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }
}
