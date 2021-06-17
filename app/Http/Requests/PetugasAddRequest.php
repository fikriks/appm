<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PetugasAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->can('create') && Auth::user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_petugas' => 'required|string|min:3|max:35',
            'username' => 'required|string|min:5|max:25|unique:petugas,username',
            'telp' => 'required|alpha_num|phone:id|min:10|max:13',
            'role' => 'required|integer|exists:roles,id',
            'password' => 'required|string|min:5|confirmed'
        ];
    }
}
