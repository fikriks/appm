<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileEditRequest;
use App\Models\Petugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profile.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileEditRequest $request)
    {
        if(Auth::guard('web')->check()){
            $petugas = Auth::user();
        } else {
            $masyarakat = auth('masyarakat')->user();
        }

        if($request->has('password')){
            if(Auth::guard('web')->check()){
                $petugas->update([
                    'password' => Hash::make($request->password)
                ]);

                Auth::logout();
            } else {
                $masyarakat->update(([
                    'password' => Hash::make($request->password)
                ]));

                auth('masyarakat')->logout();
            }

            return redirect()->route('login')->withSuccess('Berhasil mengubah password, silahkan login kembali');
        }else{
            if(Auth::guard('web')->check()){
                $petugas->update($request->only([
                    'nama_petugas', 'telp'
                ]));
            }else {
                $masyarakat->update($request->only([
                    'nik', 'nama', 'telp'
                ]));
            }
        }

        Alert::success('Berhasil', "Sukses mengedit informasi profil");
        return redirect()->route('profiles');
    }
}
