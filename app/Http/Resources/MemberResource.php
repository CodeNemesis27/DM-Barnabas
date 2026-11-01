<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class MemberResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $church = $this->church;

        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            // Always sent as plain YYYY-MM-DD so no time zone can shift the birthday.
            'date_of_birth' => $this->date_of_birth ? Carbon::parse($this->date_of_birth)->toDateString() : null,
            'phone_no' => $this->phone_no,
            'address' => $this->address,
            'church' => $church ? [
                'id' => $church->id,
                'church_code' => $church->church_code,
                'church_name' => $church->church_name,
                // Works whether or not `type` is cast to a PHP enum in the model.
                'type' => $church->type instanceof \BackedEnum ? $church->type->value : $church->type,
            ] : null,
        ];
    }
}
