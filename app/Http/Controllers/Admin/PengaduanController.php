<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class PengaduanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $cari = $request->get('cari');

        $pengaduan = Pengaduan::where('tgl_pengaduan','like','%'.$cari.'%')->orWhere('judul_laporan','like','%'.$cari.'%')->orWhere('isi_laporan','like','%'.$cari.'%')->orderBy('id','desc')->paginate(10);
        $pengaduan->appends(['cari' => $cari]);

        return view('admin.pengaduan.index',compact('pengaduan'));
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show',compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.edit',compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|string|in:proses'
        ]);

        $pengaduan->update($request->only([
            'status'
        ]));

        Alert::success('Berhasil', "Sukses mengedit pengaduan $pengaduan->judul_laporan");
        return redirect()->route('admin.pengaduan');
    }

    public function pdf()
    {
        $data = ["pengaduan" => Pengaduan::selesai()->get()];

        $pdf = PDF::loadView('admin.pengaduan.pdf', ['data'=>$data]);
        return $pdf->download('pengaduan.pdf');
    }
}
