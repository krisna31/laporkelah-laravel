<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array(auth()->user()->role_id, [Role::$IS_SUPERADMIN, Role::$IS_ADMIN])
            &&
            (int)request()->role_id >= auth()->user()->role_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required|max:255',
            'email' => 'string|required|email|max:255',
            'password' => 'string|nullable',
            'img' => 'string|nullable',
            'role_id' => 'required|in:1,2,3',
            'company_id' => 'required_unless:role,1|exists:companies,id',
        ];
    }
}
