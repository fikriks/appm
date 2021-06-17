<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Http\Requests\{PengaduanAddRequest,PengaduanEditRequest};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PengaduanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:masyarakat');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari = $request->get('cari');

        $pengaduan = Pengaduan::where(function($query){
            $query->where('masyarakat_id',Auth::guard('masyarakat')->user()->id);
        })->where(function($query) use ($cari){
            $query->where('tgl_pengaduan','like','%'.$cari.'%')->orWhere('judul_laporan','like','%'.$cari.'%')->orWhere('isi_laporan','like','%'.$cari.'%');
        });

        $pengaduan = $pengaduan->orderBy('id','desc')->paginate(10);
        $pengaduan->appends(['cari' => $cari]);

        return view('admin.pengaduan.index',compact('pengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengaduan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengaduanAddRequest $request)
    {
        $foto = $request->file('foto');
        $image_extension = $foto->extension();
        $image_name = time().'-'.Str::slug($request->judul_laporan).'.'.$image_extension;
        $image = Image::make($foto);
        $image->orientate();
        $image->save(storage_path('app/public/pengaduan/'.$image_name), 50);

        Pengaduan::create([
            'tgl_pengaduan' => Carbon::now(),
            'masyarakat_id' => Auth::guard('masyarakat')->user()->id,
            'judul_laporan' => $request->judul_laporan,
            'isi_laporan' => $request->isi_laporan,
            'foto' => $image_name,
            'status' => '0'
        ]);

        Alert::success('Berhasil', "Sukses menambahkan pengaduan $request->judul_laporan");
        return redirect()->route('masyarakat.pengaduan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show',compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.edit',compact('pengaduan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(PengaduanEditRequest $request, Pengaduan $pengaduan)
    {
        $pengaduan->update($request->only([
            'judul_laporan', 'isi_laporan'
        ]));

        if($request->hasFile('foto')){
            Storage::delete('public/app/pengaduan/'.$pengaduan->foto);
            $foto = $request->file('foto');
            $image_extension = $foto->extension();
            $image_name = time().'-'.Str::slug($request->judul_laporan).'.'.$image_extension;
            $image = Image::make($foto);
            $image->orientate();
            $image->save(storage_path('app/public/pengaduan/'.$image_name), 50);

            $pengaduan->update([
                'foto' => $image_name
            ]);
        }

        Alert::success('Berhasil', "Sukses mengedit pengaduan $request->judul_laporan");
        return redirect()->route('masyarakat.pengaduan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan)
    {
        Storage::delete('public/app/pengaduan/'.$pengaduan->foto);
        $pengaduan->delete();

        Alert::success('Berhasil', "Sukses menghapus pengaduan");
        return redirect()->route('masyarakat.   pengaduan');
    }
}
