<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/** Validates creating and updating a church (the bound {church} is present on update only). */
class ChurchRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Access is enforced by the api.role middleware on the routes.
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        $church = $this->route('church');

        return [
            'church_name' => ['required', 'string', 'max:255', Rule::unique('churches', 'church_name')->ignore($church)],
            'church_code' => ['required', 'string', 'max:50', Rule::unique('churches', 'church_code')->ignore($church)],
            'type' => ['required', Rule::in(['Church', 'Company'])],
            'locality_id' => ['required', 'integer', Rule::exists('localities', 'id')],
            'district_id' => ['required', 'integer', Rule::exists('districts', 'id')],
            'church_members' => ['nullable', 'integer', 'min:0', 'max:1000000'],
        ];
    }
}
