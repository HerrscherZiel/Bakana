<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
        return [
            //

            'kode_project' => 'required|numeric',
            'nama_project' => 'required|string|max:50',
            'tgl_mulai'    => 'required|date',
            'tgl_selesai'  => 'required|date',
            'status'       => 'required|integer',
            'ket'          => 'nullable'

        ];
    }

    public function messages()
    {
        return [
            'kode_project.required' => 'Masukan angka',
            'nama_project.required' => 'Text maksimal 50',
            'tgl_mulai.required'    => 'Masukan tanggal',
            'tgl_selesai.required'  => 'Masukan tanggal',
            'status.required'       => 'Masukan angka'
        ];
    }
}
