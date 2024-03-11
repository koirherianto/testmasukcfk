<?php

namespace App\Http\Requests;

use App\Models\Karyawan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKaryawanRequest extends FormRequest
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
        $karyawanId = $this->route('karyawan'); // Mendapatkan ID karyawan dari URL

        $rules = Karyawan::$rules;
        
        // Menambahkan aturan validasi agar NIK tidak boleh sama, kecuali untuk karyawan yang bersangkutan
        $rules['nik'] = [
            'required',
            'string',
            'max:45',
            Rule::unique('karyawans', 'nik')->ignore($karyawanId),
        ];

        return $rules;
    }
}
