<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChurchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'church_code' => $this->church_code,
            'church_name' => $this->church_name,
            // Works whether or not `type` is cast to a PHP enum in the model.
            'type' => $this->type instanceof \BackedEnum ? $this->type->value : $this->type,
            'members_count' => (int) ($this->members_count ?? 0),
        ];
    }
}
