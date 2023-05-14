<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array(auth()->user()->role_id, [Role::$IS_SUPERADMIN, Role::$IS_ADMIN]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'string|required|min:1|max:255',
            'email' => 'email|string|required',
            'password' => 'string|required',
            'role' => 'required',
            'company' => 'required_unless:role,1',
        ];
    }
}
