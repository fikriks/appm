<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\{PetugasAddRequest, PetugasEditRequest};
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari = $request->get('cari');
        $petugas = Petugas::where('nama_petugas','like','%'.$cari.'%')->orWhere('username','like','%'.$cari,'%')->orderBy('id','desc')->paginate(10);
        $petugas->appends(['cari' => $cari]);

        return view('admin.petugas.index',compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.petugas.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetugasAddRequest $request)
    {
        $petugas = Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'telp' => $request->telp,
            'password' => Hash::make($request->password)
        ]);

        $role = Role::find($request->role);
        if ($role) {
            $petugas->assignRole($role);
        }

        Alert::success('Berhasil', "Sukses menambahkan petugas $request->nama_petugas");
        return redirect()->route('admin.petugas');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Petugas $petuga)
    {
        $roles = Role::get();
        return view('admin.petugas.edit',compact('petuga','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(PetugasEditRequest $request, Petugas $petuga)
    {
        if($request->has('password')){
            $petuga->update([
                'password' => Hash::make($request->password)
            ]);
        }else{
            $petuga->update($request->only([
                'nama_petugas', 'username', 'telp'
            ]));
        }

        if ($request->has('role')) {
            $role = Role::find($request->role);
            if ($role) {
                $petuga->syncRoles([$role]);
            }
        }

        Alert::success('Berhasil', "Sukses mengedit petugas $request->nama_petugas");
        return redirect()->route('admin.petugas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petugas $petuga)
    {
       $petuga->delete();

        Alert::success('Berhasil', "Sukses menghapus petugas");
        return redirect()->route('admin.petugas');
    }
}
