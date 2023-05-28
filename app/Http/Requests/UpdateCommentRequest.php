<?php

namespace App\Http\Requests;

use App\Models\Report;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $company = Report::find($this->report_id)->company;
        return auth()->user()->id == Role::$IS_SUPERADMIN ||
            (auth()->user()->id == Role::$IS_ADMIN && (auth()->user()->company_id == $company->id || $company->is_public)) ||
            (auth()->user()->id == Role::$IS_USER && (auth()->user()->company_id == $company->id || $company->is_public));
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
