<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:masyarakat');
    }

    public function index()
    {
        $pengaduan = Pengaduan::where('masyarakat_id', Auth::guard('masyarakat')->user()->id);
        $pengaduanTotal = $pengaduan->get();
        $pengaduanDitinjau = $pengaduan->ditinjau()->get();
        $pengaduanDiproses = $pengaduan->diproses()->get();
        $pengaduanSelesai = $pengaduan->selesai()->get();

        return view('admin.dashboard.index',compact('pengaduanTotal','pengaduanDitinjau','pengaduanDiproses','pengaduanSelesai'));
    }
}
