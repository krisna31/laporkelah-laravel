<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class StoreReportApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->id == Role::$IS_SUPERADMIN ||
            (auth()->user()->id == Role::$IS_ADMIN && auth()->user()->company_id == $this->company_id && auth()->user()->id == request()->user_id) ||
            (auth()->user()->id == Role::$IS_USER && auth()->user()->company_id == $this->company_id && auth()->user()->id == request()->user_id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'company_id' => 'required|exists:companies,id',
            'title' => 'required|string',
            'keterangan' => 'required|string|max:1000',
            'status' => 'required|boolean',
            'alasan_close' => 'required_if:status,0',
            'foto' => 'required|image|file',
        ];
    }
}
