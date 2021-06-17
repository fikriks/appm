<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pengaduanTotal = Pengaduan::get();
        $pengaduanDitinjau = Pengaduan::ditinjau()->get();
        $pengaduanDiproses = Pengaduan::diproses()->get();
        $pengaduanSelesai = Pengaduan::selesai()->get();

        return view('admin.dashboard.index',compact('pengaduanTotal','pengaduanDitinjau','pengaduanDiproses','pengaduanSelesai'));
    }
}
