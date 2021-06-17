<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasyarakatEditRequest;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PDF;

class MasyarakatController extends Controller
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

        $masyarakat = Masyarakat::where('nik','like','%'.$cari.'%')->orWhere('nama','like','%'.$cari.'%')->orWhere('username','like','%'.$cari.'%')->orderBy('id','desc')->paginate(10);
        $masyarakat->appends(['cari' => $cari]);

        return view('admin.masyarakat.index',compact('masyarakat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function edit(Masyarakat $masyarakat)
    {
        return view('admin.masyarakat.edit',compact('masyarakat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function update(MasyarakatEditRequest $request, Masyarakat $masyarakat)
    {
        if($request->has('password')){
            $masyarakat->update([
                'password' => Hash::make($request->password)
            ]);
        }else{
            $masyarakat->update($request->only([
                'nik','nama', 'username', 'telp'
            ]));
        }

        Alert::success('Berhasil', "Sukses mengedit masyarakat $request->nama");
        return redirect()->route('admin.masyarakat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Masyarakat $masyarakat)
    {
        if($masyarakat->pengaduan){
            foreach($masyarakat->pengaduan as $p)
            {
                Storage::delete('pengaduan/'.$p->foto);
            }
        }
        $masyarakat->delete();

        Alert::success('Berhasil', "Sukses mengapus masyarakat");
        return redirect()->route('admin.masyarakat');
    }

    public function pdf()
    {
        $data = ["masyarakat" => Masyarakat::get()];

        $pdf = PDF::loadView('admin.masyarakat.pdf', ['data'=>$data]);
        return $pdf->download('masyarakat.pdf');
    }
}
