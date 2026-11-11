<?php

namespace App\Http\Resources;

use App\Support\ModelLabel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Church */
class ChurchResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'church_name' => $this->church_name,
            'church_code' => $this->church_code,
            'type' => $this->type,
            'church_members' => $this->church_members === null ? null : (int) $this->church_members,
            'locality_id' => (int) $this->locality_id,
            'locality_name' => ModelLabel::of($this->locality, ModelLabel::LOCALITY),
            'district_id' => (int) $this->district_id,
            'district_name' => ModelLabel::of($this->district, ModelLabel::DISTRICT),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
