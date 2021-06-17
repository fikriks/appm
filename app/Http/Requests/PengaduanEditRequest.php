<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PengaduanEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('masyarakat')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'judul_laporan' => 'required|string|min:3|max:191|'.Rule::unique('pengaduan')->ignore($this->pengaduan->id),
            'isi_laporan' => 'required|string|min:3',
            'foto' => 'nullable|file|image|mimes:png,jpg,jpeg|max:1024'
        ];
    }
}
