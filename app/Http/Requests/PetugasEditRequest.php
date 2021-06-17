<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->can('update') && Auth::user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if($request->hasAny(['password','password_confirmation'])){
            return [
                'password' => 'required|min:5|string|confirmed',
                'password_confirmation' => 'required|min:5|string'
            ];
        }else{
            return [
                'nama_petugas' => 'required|string|min:3|max:35',
                'username' => 'required|string|min:5|max:25|unique:petugas,username,' . $this->petuga->id,
                'telp' => 'required|alpha_num|phone:id|min:10|max:13',
                'role' => 'nullable|integer|exists:roles,id'
            ];
        }
    }
}
