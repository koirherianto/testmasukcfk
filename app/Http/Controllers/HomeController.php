<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Karyawan;
use \App\Models\SuratPerintahLembur;
use \App\Models\SPLStatus;
use \App\Models\User;
use \App\Models\Dapartemen;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (view()->exists('example/' . $request->path())) {
            // return view('example/' . $request->path());
            // route ke home
            return redirect()->route('home');
        }
        return view('errors.404');
    }

    public function home()
    {
        $totalKaryawan = Karyawan::count();
        $totalSPL = SuratPerintahLembur::count();
        $totalDapartemen = Dapartemen::count();
        $jumlahPenggunaAplikasi = User::count();

        $SPLs = SuratPerintahLembur::with('splStatusLatest')->get();
        $jumlahPengajuanMenunggu = 0;
        foreach ($SPLs as $SPL) {
            if ($SPL->splStatusLatest->status == 'menunggu') {
                $jumlahPengajuanMenunggu++;
            }
        }

        $jumlahPengajuanDisetujui = SuratPerintahLembur::whereHas('splStatusLatest', function ($query) {
            $query->where('status', 'disetujui');
        })->count();

        $jumlahPengajuanDitolak = SuratPerintahLembur::whereHas('splStatusLatest', function ($query) {
            $query->where('status', 'ditolak');
        })->count();

        $totalJamLemburBulanIni = SuratPerintahLembur::whereMonth('created_at', date('m'))->sum('total_jam_lembur') / 10000;
        $totalJamLemburBulanIni = round($totalJamLemburBulanIni, 2);
        

        return view('index',compact('totalKaryawan','totalSPL','totalDapartemen','jumlahPengajuanMenunggu','jumlahPengajuanDisetujui','jumlahPengajuanDitolak','jumlahPenggunaAplikasi','totalJamLemburBulanIni'));
    }

}
