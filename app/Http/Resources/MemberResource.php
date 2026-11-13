<?php

namespace App\Http\Resources;

use App\Support\PersonName;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/** @mixin \App\Models\Member */
class MemberResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => (int) $this->user_id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'suffix' => $this->suffix,
            'full_name' => PersonName::full($this->first_name, $this->middle_name, $this->last_name, $this->suffix),
            'gender' => $this->gender,
            // A plain calendar date: no time and no timezone to shift it.
            'date_of_birth' => $this->date_of_birth ? Carbon::parse($this->date_of_birth)->format('Y-m-d') : null,
            'civil_status' => $this->civil_status,
            'occupation' => $this->occupation,
            'address' => $this->address,
            'phone_no' => $this->phone_no,
            'alternate_phone_no' => $this->alternate_phone_no,
            'facebook_account' => $this->facebook_account,
            'church_id' => (int) $this->church_id,
            'church_name' => $this->church?->church_name,
            'church_code' => $this->church?->church_code,
            'class' => $this->class,
            'status' => $this->status,
            'remarks' => $this->remarks,
            // Only the single-member endpoints load the account.
            'email' => $this->relationLoaded('user') ? $this->user?->email : null,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
