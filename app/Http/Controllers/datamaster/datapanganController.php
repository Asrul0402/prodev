<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\KemasExport;
use App\Exports\AkgExport;
use App\Exports\BpomExport;
use App\Exports\klaimexport;
use App\Exports\SKUExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Auth;
use redirect;

use App\pkp\pkp_type;
use App\pkp\pkp_project;
use App\pkp\project_pdf;
use App\pkp\pkp_detail_project;
use App\pkp\pkp_uniq_idea;
use Carbon\Carbon;
use App\pkp\pkp_estimasi_market;
use App\master\brand;
use App\pkp\menu;
use App\pkp\jenismenu;
use App\notification;
use App\pkp\komponen_klaim;
use App\devnf\tb_akg;
use App\master\Tarkon;
use App\pkp\promo;
use App\kemas\datakemas;
use App\pkp\data_sku;
use App\pkp\data_promo;
use App\nutfact\datapangan;
use App\pkp\coba;
use App\pkp\tipp;
use App\nutfact\pangan;
use App\manager\pengajuan;
use App\pkp\picture;
use App\users\Departement;

class datapanganController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $pangan = pangan::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.datapangan')->with([
            'pangan' => $pangan,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif

        ]);
    }

    public function akg(){
        $akg = tb_akg::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.akg')->with([
            'akg' => $akg,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function kemas(){
        $kemas = datakemas::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.datakemas')->with([
            'kemas' => $kemas,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function klaim(){
        $klaim =komponen_klaim::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.komponenklaim')->with([
            'klaim' => $klaim,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function sku(){
        $sku = data_sku::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.sku')->with([
            'sku' => $sku,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function exportsku()
	{
		return Excel::download(new SKUExport, 'SKU.xlsx');
    }

    public function export_excel()
	{
		return Excel::download(new KemasExport, 'kemas.xlsx');
    }

    public function export_klaim()
	{
		return Excel::download(new klaimexport, 'klaim.xlsx');
    }
    
    public function exportAkg()
	{
		return Excel::download(new AkgExport, 'Akg.xlsx');
    }
    
    public function exportBpom()
	{
		return Excel::download(new BpomExport, 'BPOM.xlsx');
	}
}
