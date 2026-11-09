<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'gender',
        'date_of_birth',
        'civil_status',
        'occupation',
        'address',
        'phone_no',
        'alternate_phone_no',
        'facebook_account',
        'church_id',
        'class',
        'status',
        'remarks',
        'created_by',
    ];

    public function deathRecords(): HasMany
    {
        return $this->hasMany(DeathRecord::class);
    }

    public function memberContributions(): HasMany
    {
        return $this->hasMany(MemberContribution::class);
    }

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
