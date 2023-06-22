<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class StoreReportApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $company = Company::find($this->company_id);
        return auth()->user()->role_id == Role::$IS_SUPERADMIN ||
            (in_array(auth()->user()->role_id, [Role::$IS_SUPERADMIN, Role::$IS_ADMIN, Role::$IS_USER])
                &&
                ($company->id == auth()->user()->company_id || $company->is_public));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'company_id' => 'required|exists:companies,id',
            'keterangan' => 'required|string|max:1000',
            'alasan_close' => 'required_if:status,0',
            'foto' => 'required|image',
        ];
    }
}
