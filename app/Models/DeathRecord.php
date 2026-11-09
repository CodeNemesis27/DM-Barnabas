<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeathRecord extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'death_record_ref_no',
        'member_id',
        'date_of_death',
        'place_of_death',
        'death_cause_type',
        'cause_of_death',
        'death_cert_number',
        'death_cert_image',
        'remarks',
        'created_by',
    ];

    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
