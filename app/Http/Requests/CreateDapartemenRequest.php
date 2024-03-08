<?php

namespace App\Http\Requests;

use App\Models\Dapartemen;
use Illuminate\Foundation\Http\FormRequest;

class CreateDapartemenRequest extends FormRequest
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
        return Dapartemen::$rules;
    }
}
