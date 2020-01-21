<?php

namespace App\Http\Controllers;

use App\pkp\pkp_type;
use App\pkp\pkp_project;
use App\pkp\project_pdf;
use App\pkp\pkp_detail_project;
use App\pkp\pkp_uniq_idea;
use App\pkp\pkp_estimasi_market;
use App\master\brand;
use App\master\Tarkon;
use App\pkp\promo;
use App\kemas\datakemas;
use App\pkp\data_promo;
use App\nutfact\datapangan;
use App\pkp\coba;
use App\notification;
use App\pkp\tipp;
use App\nutfact\pangan;
use App\manager\pengajuan;
use App\pkp\picture;
use App\users\Departement;
use App\pkp\menu;
use App\pkp\jenismenu;
use Illuminate\Http\Request;
use Auth;
use DB;
use redirect;

class menuController extends Controller
{
    public function menukalender(){
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('pv.menucalender')->with([
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function data(){
        $hilo1 = pkp_project::where('id_brand','=','Hilo')->count();$hilo2 = project_pdf::where('id_brand','=','Hilo')->count();$hhilo = $hilo1 + $hilo2;
        $lmen1 = pkp_project::where('id_brand','=','L-Men')->count();$lmen2 = project_pdf::where('id_brand','=','L-Men')->count();$hlmen = $lmen1 + $lmen2;
        $nr1 = pkp_project::where('id_brand','=','Nutrisari')->count();$nr2 = project_pdf::where('id_brand','=','Nutrisari')->count();$hnr = $nr1 + $nr2;
        $wrp1 = pkp_project::where('id_brand','=','WRP')->count();$wrp2 = project_pdf::where('id_brand','=','WRP')->count();$hwrp = $wrp1 + $wrp2;
        $ts1 = pkp_project::where('id_brand','=','Tropicana Slim')->count();$ts2 = project_pdf::where('id_brand','=','Tropicana Slim')->count();$hts = $ts1 + $ts2;
        $hb1 = pkp_project::where('id_brand','=','Heavenly Blush')->count();$hb2 = project_pdf::where('id_brand','=','Heavenly Blush')->count();$hhb = $hb1 + $hb2;
        $ekspor1 = pkp_project::where('id_brand','=','Ekspor')->count();$ekspor2 = project_pdf::where('id_brand','=','Ekspor')->count();$hekspor = $ekspor1 + $ekspor2;
        $draf = pkp_project::where('status_project','=','draf')->count();$draf1 = project_pdf::where('status_project','=','draf')->count();$hdraf = $draf + $draf1;
        $revisi = pkp_project::where('status_project','=','revisi')->count();$revisi1 = project_pdf::where('status_project','=','revisi')->count();$hrevisi = $revisi + $revisi1;
        $proses = pkp_project::where('status_project','=','proses')->count();$proses1 = project_pdf::where('status_project','=','proses')->count();$hproses = $proses + $proses1;
        $sent= pkp_project::where('status_project','=','sent')->count();$sent1 = project_pdf::where('status_project','=','sent')->count();$hsent = $sent + $sent1;
        $close = pkp_project::where('status_project','=','close')->count();$close1 = project_pdf::where('status_project','=','close')->count();$hclose = $close + $close1;
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('pv.data')->with([
            'pesan' => $pesan,
            'notif' =>$notif,
            'hdraf' => $hdraf,
            'hrevisi' => $hrevisi,
            'hproses' => $proses,
            'hsent' => $hsent,
            'hclose' => $hclose,
            'hhilo' => $hhilo,
            'hlmen' => $hlmen,
            'hnr' => $hnr,
            'hwrp' => $hwrp,
            'hts' => $hts,
            'hhb' => $hhb,
            'hekspor' => $hekspor,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }
}
