<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class TanggapanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari = $request->get('cari');

        $tanggapan = Tanggapan::where('tgl_tanggapan','like','%'.$cari.'%')->orderBy('id','desc')->paginate(10);
        $tanggapan->appends(['cari' => $cari]);

        return view('admin.tanggapan.index',compact('tanggapan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengaduan = Pengaduan::diproses()->get();

        return view('admin.tanggapan.create',compact('pengaduan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pengaduan' => 'required|exists:pengaduan,id',
            'tanggapan' => 'required|string|min:5'
        ]);

        Tanggapan::create([
            'pengaduan_id' => $request->pengaduan,
            'tgl_tanggapan' => Carbon::now(),
            'tanggapan' => $request->tanggapan,
            'petugas_id' => Auth::id()
        ]);

        $pengaduan = Pengaduan::findOrFail($request->pengaduan);
        $pengaduan->update([
            'status' => 'selesai'
        ]);

        Alert::success('Berhasil', "Sukses menambahkan tanggapan");
        return redirect()->route('admin.tanggapan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function show(Tanggapan $tanggapan)
    {
        return view('admin.tanggapan.show',compact('tanggapan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tanggapan $tanggapan)
    {
        $pengaduan = Pengaduan::selesai()->get();

        return view('admin.tanggapan.edit',compact('tanggapan','pengaduan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tanggapan $tanggapan)
    {
        $request->validate([
            'tanggapan' => 'required|string|min:5'
        ]);

        $tanggapan->update([
            'tanggapan' => $request->tanggapan
        ]);

        Alert::success('Berhasil', "Sukses mengedit tanggapan");
        return redirect()->route('admin.tanggapan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tanggapan $tanggapan)
    {
        $tanggapan->delete();

        Alert::success('Berhasil', "Sukses menghapus tanggapan");
        return redirect()->route('admin.tanggapan');
    }

    public function pdf()
    {
        $data = ["tanggapan" => Tanggapan::get()];

        $pdf = PDF::loadView('admin.tanggapan.pdf', ['data'=>$data]);
        return $pdf->download('tanggapan.pdf');
    }
}
