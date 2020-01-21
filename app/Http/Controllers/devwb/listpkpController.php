<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\pkp\pkp_type;
use App\pkp\pkp_project;
use App\pkp\project_pdf;
use App\pkp\pkp_detail_project;
use App\pkp\pkp_uniq_idea;
use App\pkp\pkp_estimasi_market;
use App\master\Brand;
use App\pkp\menu;
use App\pkp\jenismenu;
use App\notification;
use App\master\Tarkon;
use App\pkp\promo;
use App\kemas\datakemas;
use App\pkp\data_promo;
use App\nutfact\datapangan;
use App\pkp\coba;
use App\pkp\tipp;
use App\nutfact\pangan;
use App\manager\pengajuan;
use App\pkp\picture;
use App\users\Departement;

use Auth;
use DB;
use Redirect;

class listpkpController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:marketing' || 'rule:user_produk'  || 'rule:kemas');
    }

    public function dasboard(){
        $pkp = pkp_project::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $pkp1 = pkp_project::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapkp = $pkp + $pkp1;
        $pdf = project_pdf::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $pdf1 = project_pdf::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapdf = $pdf + $pdf1;
        $promo = promo::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $promo1 = promo::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapromo = $promo + $promo1;
        return view('devwb.dasboard')->with([
            'pkp' => $datapkp,
            'pdf' => $datapdf,
            'promo' => $datapromo
        ]);
    }

    public function listpkp(){
        $pkp = pkp_project::where('status_project','!=','draf')->where('status_project','!=','sent')->get();
        $type = pkp_type::all();
        $brand = brand::all();
        $hitungpkp = tipp::where('status_pkp','=','draf')->count();
        $hitungpromo = data_promo::where('status_promo','=','draf')->count();
        $hitungpdf = coba::where('status_data','=','draf')->count();
        $jumlah = $hitungpkp+$hitungpromo+$hitungpdf;
        
        return view('devwb.listprojectpkp')->with([
            'type' => $type,
            'brand' => $brand,
            'pkp' => $pkp,
            'hitungpkp' => $hitungpkp,
            'hitungpromo' => $hitungpromo,
            'hitungpdf' => $hitungpdf,
            'jumlah' => $jumlah
        ]);
    }

    public function listpdf(){
        $pdf = DB::table('pdf_project')->get();
        $type = pkp_type::all();
        $brand = brand::all();
        $hitungpkp = tipp::where('status_pkp','=','draf')->count();
        $hitungpromo = data_promo::where('status_promo','=','draf')->count();
        $hitungpdf = coba::where('status_data','=','draf')->count();
        $jumlah = $hitungpkp+$hitungpromo+$hitungpdf;
        
        return view('devwb.listprojectpdf')->with([
            'type' => $type,
            'pdf' => $pdf,
            'brand' => $brand,
            'hitungpkp' => $hitungpkp,
            'hitungpromo' => $hitungpromo,
            'hitungpdf' => $hitungpdf,
            'jumlah' => $jumlah
        ]);
    }

    public function listpromo(){
        $promo = promo::all();
        $brand = brand::all();
        
        return view('devwb.listprojectpromo')->with([
            'promo' => $promo,
            'brand' => $brand
        ]);
    }

    public function kemas(){
        return view('datamaster.datakemas');
    }

    public function closepkp(Request $request,$id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->status_project='close';
        $pkp->catatan=$request->note;
        $pkp->save();

        return Redirect::back();
    }

    public function closepdf(Request $request,$id_project_pdf){
        $pdf = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $pdf->status_project='close';
        $pdf->catatan=$request->note;
        $pdf->save();

        return Redirect::back();
    }

    public function closepromo(Request $request,$id_pkp_promo){
        $pkp = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $pkp->status_project='close';
        $pkp->catatan=$request->note;
        $pkp->save();

        return Redirect::back();
    }

    public function allproject(){
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $pic = picture::all();
        $pkp = tipp::max('turunan');
        $pdf = coba::max('turunan');
        $promo = data_promo::max('turunan');
        $hitungnotif = $pengajuan + $notif;
        $datapkp = pkp_project::where('status_project','!=','draf') ->join('tippu','pkp_project.id_project','=','tippu.id_pkp')->where('status_data','=','active')->get();
        $datapdf = project_pdf::where('status_project','!=','draf') ->join('tipu','pdf_project.id_project_pdf','=','tipu.pdf_id')->where('status_pdf','=','active')->get();
        $datapromo = promo::where('status_project','!=','draf') ->join('isi_promo','pkp_promo.id_pkp_promo','=','isi_promo.id_pkp_promoo')->where('status_data','=','active')->get();
        return view('produk.allproject')->with([
            'datapkp' => $datapkp,
            'datapdf' => $datapdf,
            'pic' => $pic,
            'datapromo' => $datapromo,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

}