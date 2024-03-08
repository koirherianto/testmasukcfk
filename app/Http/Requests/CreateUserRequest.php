<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = User::$rules;
        unset($rules['email_verified_at']);
         // Tambahkan aturan validasi untuk 's_dapartemen_id'
        $rules['s_dapartemen_id'] = 'required|array|min:1';
        $rules['s_role_id'] = 'required|array|min:1';
        return $rules;
    }
}
