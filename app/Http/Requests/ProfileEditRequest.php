<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('masyarakat')->check() || Auth::guard('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if(Auth::guard('web')->check()){
        if($request->hasAny(['password','password_confirmation'])){
            return [
                'current_password' => 'required|min:5|string',
                'password' => 'required|min:5|string|confirmed',
                'password_confirmation' => 'required|min:5|string'
            ];
        }else{
            return [
                'nama_petugas' => 'required|string|min:3|max:191',
                'telp' => 'required|alpha_num|phone:id|min:10|max:13'
            ];
        }
    } else {
        if($request->hasAny(['password','password_confirmation'])){
            return [
                'current_password' => 'required|min:5|string',
                'password' => 'required|min:5|string|confirmed',
                'password_confirmation' => 'required|min:5|string'
            ];
        }else{
            return [
                'nik' => 'required|alpha_num|min:16|max:16|'.Rule::unique('masyarakat')->ignore(Auth::guard('masyarakat')->user()->id),
                'nama' => 'required|string|min:3|max:191',
                'telp' => 'required|alpha_num|phone:id|min:10|max:13'
            ];
        }
    }
    }

    public function withValidator($validator)
    {
        if ($this->current_password) {
            $validator->after(function ($validator) {
                if (!Hash::check($this->current_password, Auth::guard('web')->check() ? Auth::user()->password : auth('masyarakat')->user()->password)) {
                    $validator->errors()->add('current_password', 'Password akun salah');
                } else if ($this->current_password == $this->password) {
                    $validator->errors()->add('password', 'Password baru dan password lama, tidak boleh sama');
                }
            });
        }
    }
}
