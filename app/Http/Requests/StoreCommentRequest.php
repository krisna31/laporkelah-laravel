<?php

namespace App\Http\Requests;

use App\Models\Report;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $company = Report::find($this->report_id)->company ?? null;
        return auth()->user()->role_id == Role::$IS_SUPERADMIN ||
            (in_array(auth()->user()->role_id, [Role::$IS_ADMIN, Role::$IS_USER]) &&
                (($company->is_public ?? true) || (auth()->user()->company_id == $company->id ?? true)));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'report_id' => 'required|exists:reports,id',
            'isi' => 'required|string|max:500',
        ];
    }
}
