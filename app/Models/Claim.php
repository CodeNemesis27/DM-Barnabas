<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claim extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'claim_ref_no',
        'death_record_id',
        'claimant_name',
        'claimant_relationship',
        'claimant_phone_no',
        'status',
        'remarks',
        'approved_by',
        'approved_at',
        'requested_by',
    ];

    public function deathRecord(): BelongsTo
    {
        return $this->belongsTo(DeathRecord::class);
    }

    public function requestedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
