<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * Validates adding and editing a member. Adding also needs a login account for the member: either a new
 * one (email + password) or an existing one that is not linked to a member yet.
 */
class MemberRequest extends FormRequest
{
    /** Columns of the members table this request is allowed to write. */
    private const MEMBER_FIELDS = [
        'first_name', 'middle_name', 'last_name', 'suffix', 'gender', 'date_of_birth', 'civil_status',
        'occupation', 'address', 'phone_no', 'alternate_phone_no', 'facebook_account', 'church_id',
        'class', 'status', 'remarks',
    ];

    public function authorize(): bool
    {
        // Access is enforced by the api.role middleware on the routes.
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (is_string($this->input('email'))) {
            $this->merge(['email' => Str::lower($this->input('email'))]);
        }
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', Rule::in(['II', 'III', 'Jr.', 'Sr.'])],
            'gender' => ['required', Rule::in(['Male', 'Female'])],
            'date_of_birth' => ['required', 'date_format:Y-m-d', 'after_or_equal:1900-01-01', 'before_or_equal:today'],
            'civil_status' => ['required', Rule::in(['Single', 'Married', 'Separated', 'Widowed'])],
            'occupation' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:1000'],
            'phone_no' => ['required', 'string', 'max:50'],
            'alternate_phone_no' => ['nullable', 'string', 'max:50'],
            'facebook_account' => ['nullable', 'string', 'max:255'],
            'church_id' => ['required', 'integer', Rule::exists('churches', 'id')->whereNull('deleted_at')],
            'class' => ['required', Rule::in(['A', 'B'])],
            'status' => ['required', Rule::in(['Active', 'Deceased'])],
            'remarks' => ['nullable', 'string', 'max:2000'],
        ];

        if ($this->isMethod('POST')) {
            // A new member always starts as Active.
            $rules['status'] = ['nullable', Rule::in(['Active'])];

            $rules += [
                'account_mode' => ['required', Rule::in(['new', 'existing'])],
                'email' => ['required_if:account_mode,new', 'nullable', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
                'password' => ['required_if:account_mode,new', 'nullable', 'string', Password::defaults()],
                'user_id' => [
                    'required_if:account_mode,existing',
                    'nullable',
                    'integer',
                    Rule::exists('users', 'id')->where('role', 'Member'),
                    Rule::unique('members', 'user_id')->whereNull('deleted_at'),
                ],
            ];
        }

        return $rules;
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'That email address is already registered.',
            'user_id.exists' => 'Select a valid member account.',
            'user_id.unique' => 'This account is already linked to a member.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'phone_no' => 'phone number',
            'alternate_phone_no' => 'alternate phone number',
            'date_of_birth' => 'date of birth',
            'civil_status' => 'civil status',
            'facebook_account' => 'Facebook account',
            'church_id' => 'church',
            'user_id' => 'account',
        ];
    }

    /**
     * Only the columns that belong to the members table.
     *
     * @return array<string, mixed>
     */
    public function memberData(): array
    {
        $data = Arr::only($this->validated(), self::MEMBER_FIELDS);

        if ($this->isMethod('POST')) {
            $data['status'] = 'Active';
        }

        return $data;
    }
}
