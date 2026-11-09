<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Church extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'church_name',
        'church_code',
        'type',
        'locality_id',
        'district_id',
        'church_members',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function locality(): BelongsTo
    {
        return $this->belongsTo(Locality::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
