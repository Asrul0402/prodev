<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pkp\pkp_type;
use Illuminate\Support\Facades\Validator;
use App\pkp\pkp_project;
use App\pkp\project_pdf;
use App\pkp\product_allocation;
use Carbon\Carbon;
use App\pkp\apppromo;
use App\master\Brand;
use App\manager\pengajuan;
use App\pkp\pkp_uniq_idea;
use App\users\Departement;
use App\pkp\pkp_estimasi_market;
use App\pkp\promo;
use App\pkp\data_promo;
use App\pkp\picture;
use App\notification;
use App\pkp\data_sku;
use App\pkp\tipp;
use App\pkp\coba;
use Auth;
use DB;
use Calendar;
use Redirect;

class promoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_global' || 'rule:pv_lokal' || 'rule:marketing' || 'rule:NR' || 'rule:manager' || 'rule:CS');
    }

    public function promo(){
        $type = pkp_type::all();
        $brand = brand::all();
        $idea = pkp_uniq_idea::all();
        $market = pkp_estimasi_market::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('promo.pkppromo')->with([
            'type' => $type,
            'market' => $market,
            'idea' => $idea,
            'brand' => $brand,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function buatpromo($id_pkp_promo){
        $pkp= promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $promo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $data = data_promo::where('id_pkp_promoo',$id_pkp_promo)->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('promo.datapromo')->with([
            'pkp' => $pkp,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'promo' => $promo,
            'data' => $data
        ]);
    }

    public function buatpromo1($id_pkp_promo,$revisi,$turunan){
        $pkp= promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $promo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $data = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('promo.datapromo1')->with([
            'pkp' => $pkp,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'promo' => $promo,
            'data' => $data
        ]);
    }

    public function isipromo(Request $request){
        $promo= new promo;
        $promo->brand=$request->brand;
        $promo->Author=$request->author;
        $promo->created_date=$request->create;
        $promo->country=$request->county;
        $promo->promo_type=$request->promo;
        $promo->project_name=$request->name;
        $promo->type=$request->type;
        $promo->save();

        return redirect()->Route('rekappromo',$promo->id_pkp_promo);
    }

    public function drafpromo(){
        $promo = promo::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('promo.drafpromo')->with([
            'promo' => $promo,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function listpromo(){
        $promo = promo::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('promo.listpromo')->with([
            'promo' => $promo,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function hapuspromo($id_pkp_promo){
        $promo= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $promo->delete();

        $Dpromo= data_promo::where('id_pkp_promoo',$id_pkp_promo)->first();
        if($Dpromo!=NULL){
        $Dpromo->delete();
        }

        $story= notification::where('id_promo',$id_pkp_promo)->first();
        if($story!=NULL){
            $story->delete();
        }

        return redirect::back();
    }

    public function prioritas(Request $request,$id_pkp_promo){
        $pkp = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $pkp->prioritas=$request->prioritas;
        $pkp->save();

        return redirect::back();
    }

    public function daftarpromo($id_pkp_promo){
        $pengajuanpromo = promo::join('pkp_pengajuan','pkp_promo.id_pkp_promo','=','pkp_pengajuan.id_promo')->where('penerima','=','5')->count();
        $data = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $max = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $max2 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('revisi');
        $pkp = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('turunan',$max)->orderBy('turunan','desc')->where('revisi',$max2)->get();
        $promo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view ('promo.daftarpromo')->with([
            'data' => $data,
            'promo' => $promo,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'pkp' => $pkp,
            'pengajuanpromo' => $pengajuanpromo
        ]);
    }

    public function step1($id_pkp_promo){
        $pkp = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $pengajuan = pengajuan::count();
        $brand = brand::all();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('promo.step1')->with([
            'pkp' => $pkp,
            'brand' => $brand,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function promo1($id_pkp_promo,$revisi,$turunan){
        $pkp = data_promo::where([ ['id_pkp_promoo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $brand = brand::all();
        return view('promo.promo1')->with([
            'pkp' => $pkp,
            'brand' => $brand,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function editpromo1(Request $request,$id_pkp_promo){
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $promo->perevisi=$request->perevisi;
        $promo->last_update=$request->last_up;
        $promo->brand=$request->brand;
        $promo->project_name=$request->name;
        $promo->save();

        return redirect::Route('datapromo',$promo->id_pkp_promo);
    }

    public function editpromo11(Request $request,$id_pkp_promo,$revisi,$turunan){
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $promo->perevisi=$request->perevisi;
        $promo->last_update=$request->last_up;
        $promo->brand=$request->brand;
        $promo->project_name=$request->name;
        $promo->save();

        return redirect::Route('datapromo11',[$id_pkp_promo,$revisi,$turunan]);
    }

    public function step4($id_pkp_promo,$revisi,$turunan){
        $allocation = product_allocation::where([ ['id_pkp_promo',$id_pkp_promo],['revisi',$revisi],['turunan',$turunan]])->get();
        $hitung = product_allocation::where('id_pkp_promo',$id_pkp_promo)->count();
        $promo = data_promo::where([ ['id_pkp_promoo',$id_pkp_promo],['revisi',$revisi],['turunan',$turunan]])->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $sku = data_sku::all();
        $sku2 = data_sku::all();
        return view('promo.step4')->with([
            'promo' => $promo,
            'allocation' => $allocation,
            'hitung' => $hitung,
            'sku' => $sku,
            'sku2' => $sku2,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function editdatastep4(Request $request, $id_product_allocation,$turunan){
        $allocation = product_allocation::where([['id_product_allocation',$id_product_allocation],['turunan',$turunan]])->first();
        $allocation->product_sku = $request->product;
        $allocation->allocation = $request->allocation;
        $allocation->remarks = $request->remarks;
        $allocation->start = $request->start;
        $allocation->end = $request->end;
        $allocation->rto=$request->rto;
        $allocation->save();
        return redirect::back();
    }

    public function deletedatastep4($id_pkp_promo,$turunan){
        $allocation = product_allocation::where([ ['id_pkp_promo',$id_pkp_promo], ['turunan',$turunan] ])->first();
        $allocation->delete();

        return redirect::back();
    }

    public function uploaddatapkp(Request $request){
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'required|file|max:3072'
        ]);
        $files = [];
        foreach ($request->file('filename') as $file) {
            if ($file->isValid()) {
                $path = $file->store('public/storage');
                $form=$request->id;
                $turunan=$request->turunan;
                $files[] = [
                    'filename' => $file->getClientOriginalName(),
                    'lokasi' => $path,
                    'promo' => $form,
                    'turunan' => $turunan,
                ];
            }
        }
        picture::insert($files);
        return redirect()
        ->back()
        ->withSuccess(sprintf('%s file uploaded successfully.', count($files)));
    }

    public function uploadpromo($id_pkp_promo,$revisi,$turunan){
        $pengajuanpromo = promo::join('pkp_pengajuan','pkp_promo.id_pkp_promo','=','pkp_pengajuan.id_promo')->count();
        $pkp= promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $coba = picture::where('promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get(); 
        $id_pkp= data_promo::where([ ['id_pkp_promoo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('promo.step5')->with([
            'pkp' => $pkp,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'pengajuanpromo' => $pengajuanpromo,
            'coba' => $coba,
            'id_pkp' => $id_pkp
        ]);
    }

    public function approve1(Request $request,$id_pkp_promo){
        $pdf = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $pdf->status_terima='terima';
        $pdf->tgl_terima=$request->tgl;
        $pdf->save();

        return redirect::back();
    }

    public function approve2(Request $request,$id_pkp_promo){
        $pdf = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $pdf->status_terima2='terima';
        $pdf->tgl_terima2=$request->tgl;
        $pdf->save();

        return redirect::back();
    }

    public function freeze(Request $request,$id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_freeze='active';
        $data->freeze=Auth::user()->id;
        $data->waktu_freeze=Carbon::now();
        $data->note_freeze=$request->notefreeze;
        $data->save();

        return redirect::back()->with('status', 'Project '.$data->project_name.' has been disabled!');
    }

    public function ubahTM(Request $request,$id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_project='revisi';
        $data->save();

        $pengajuan= new pengajuan;
        $pengajuan->prioritas_pengajuan=1;
        $pengajuan->id_promo=$request->pkp;
        $pengajuan->penerima='14';
        $pengajuan->alasan_pengajuan=$request->lamafreeze;
        $pengajuan->save();

        return redirect::back();
    }

    public function active($id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_freeze='inactive';
        $data->save();

        return redirect::back();
    }

    public function TMubah(Request $request,$id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_project='sent';
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->status_freeze='inactive';
        $data->freeze_diaktifkan=Carbon::now();
        $data->save();

        $pengajuan = pengajuan::where('id_promo',$id_pkp_promo)->first();
        $pengajuan->delete();

        return redirect::back();
    }

    public function downloadpromo($id_pkp_promo,$revisi,$turunan){
        $promoo = data_promo::join('pkp_promo','isi_promo.id_pkp_promoo','=','pkp_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $promo1 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        $app = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        $jumlahpromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $nopromo = DB::table('pkp_promo')->max('promo_number')+1;
        $picture = picture::where('promo',$id_pkp_promo)->get();
        $dept = Departement::all();
        $dept1 = Departement::all();
        $allocation = product_allocation::where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        return view('promo.downloadpromo')->with([
            'promo' => $promo,
            'promo1' => $promo1,
            'promoo' => $promoo,
            'app' => $app,
            'picture' => $picture,
            'allocation' => $allocation,
            'nopromo' => substr("T00".$nopromo,1,3),
            'dept' => $dept,
            'dept1' => $dept1,
            'jumlahpromo' => $jumlahpromo
        ]);
    }
 
    public function lihatpromo($id_pkp_promo,$revisi,$turunan){
        $pengajuanpromo = promo::join('pkp_pengajuan','pkp_promo.id_pkp_promo','=','pkp_pengajuan.id_promo')->count();
        $promoo = data_promo::join('pkp_promo','isi_promo.id_pkp_promoo','=','pkp_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $max = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $promo1 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('turunan','<=',$turunan)->where('revisi','<=',$revisi)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $promo2 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan',$max)->orderBy('revisi','desc')->orderBy('turunan','desc')->get();
        $app = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        $app2 = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan',$max)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $jumlahpromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $nopromo = DB::table('pkp_promo')->max('promo_number')+1;
        $picture = picture::where('promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        $dept = Departement::all();
        $dept1 = Departement::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $allocation = product_allocation::where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $user = DB::table('users')->join('pkp_promo','pkp_promo.tujuankirim','=','users.departement_id')->get();
        return view('promo.lihatpromo')->with([
            'promo' => $promo,
            'promo1' => $promo1,
            'promo2' => $promo2,
            'promoo' => $promoo,
            'app' => $app,
            'app2' => $app2,
            'picture' => $picture,
            'pengajuanpromo' => $pengajuanpromo,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'allocation' => $allocation,
            'nopromo' => substr("T00".$nopromo,1,3),
            'user' => $user,
            'dept' => $dept,
            'dept1' => $dept1,
            'jumlahpromo' => $jumlahpromo
        ]);
    }

    public function edittype(Request $request, $id_pkp_promo){
        $type = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $type->type=$request->type;
        $type->save();

        return redirect::back();
    }

    public function datapromo(Request $request){
        $promo = new data_promo;
        $promo->id_pkp_promoo=$request->id_promo;
        $promo->promo_idea=$request->promo_idea;
        $promo->dimension=$request->dimension;
        $promo->application=$request->application;
        $promo->promo_readiness=$request->promo;
        $promo->rto=$request->rto;
        $promo->turunan='0';
        $promo->revisi='0';
        $promo->gambaran_proses=$request->proses;
        $promo->save();

        $notif = new notification;
        $notif->id_promo=$promo->id_pkp_promoo;
        $notif->title="Add Data PROMO";
        $notif->turunan=$promo->turunan;
        $notif->perevisi=Auth::user()->id;
        $notif->save();
        return redirect::route('promo4',['id_pkp_promo'=> $promo->id_pkp_promoo,'revisi' => $promo->revisi,'turunan' => $promo->turunan])->with('status', 'Data has been added up');
    }

    public function editdatapromo2(Request $request,$id_pkp_promoo,$revisi,$turunan){
        $promo = data_promo::where([ ['id_pkp_promoo',$id_pkp_promoo], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $promo->id_pkp_promoo=$request->id_promo;
        $promo->promo_idea=$request->promo_idea;
        $promo->dimension=$request->dimension;
        $promo->application=$request->application;
        $promo->promo_readiness=$request->promo;
        $promo->rto=$request->rto;
        $promo->gambaran_proses=$request->proses;
        $promo->save();

        $notif = notification::where('id_promo',$id_pkp_promoo)->first();
        $notif->id_promo=$promo->id_pkp_promoo;
        $notif->title="Edit Data PROMO";
        $notif->turunan=$promo->turunan;
        $notif->status='active';
        $notif->perevisi=Auth::user()->id;
        $notif->save();

        return redirect::route('promo4',['id_pkp_promo'=> $promo->id_pkp_promoo,'revisi' => $promo->revisi,'turunan' => $promo->turunan])->with('status', 'Data has been added up');
    }

    public function editdatapromo(Request $request,$id_pkp_promoo,$revisi,$turunan){
        $promo = promo::where('id_pkp_promo',$id_pkp_promoo)->first();
        $naikversi = $promo->turunan + 1;

        $datapromo = data_promo::where('id_pkp_promoo',$id_pkp_promoo)->where('revisi',$revisi)->where('turunan',$promo)->first();
        $datapromo->status_data='inactive';
        $datapromo->save();

        $clf=data_promo::where('id_pkp_promoo',$id_pkp_promoo)->where('turunan',$turunan)->count();
        if($clf>0){
            $isipromo=data_promo::where([ ['id_pkp_promoo',$id_pkp_promoo], ['revisi',$revisi], ['turunan',$turunan] ])->get();
            foreach ($isipromo as $promoo)
            {
                $promo = new data_promo;
                $promo->id_pkp_promoo=$request->id_promo;
                $promo->promo_idea=$request->promo_idea;
                $promo->dimension=$request->dimension;
                $promo->application=$request->application;
                $promo->promo_readiness=$request->promo;
                $promo->rto=$request->rto;
                $promo->turunan=$naikversi;
                $promo->status_data='active';
                $promo->revisi=$promoo->revisi;
                $promo->gambaran_proses=$request->proses;
                $promo->save();
            }
        }
        $allocation = product_allocation::where('id_pkp_promo',$id_pkp_promoo)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($allocation>0){
            $isiallocation = product_allocation::where('id_pkp_promo',$id_pkp_promoo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach($isiallocation as $all)
            {
                $al= new product_allocation;
                $al->id_pkp_promo=$all->id_pkp_promo;
                $al->product_sku=$all->product_sku;
                $al->allocation=$all->allocation;
                $al->remarks=$all->remarks;
                $al->start=$all->start;
                $al->end=$all->end;
                $al->turunan=$naikversi;
                $al->revisi=$all->revisi;
                $al->rto=$all->rto;
                $al->opsi=$all->opsi;
                $al->save();
            }
        }

        $notif = notification::where('id_promo',$id_pkp_promoo)->first();
        $notif->id_promo=$promo->id_pkp_promoo;
        $notif->title="Edit Data PROMO";
        $notif->turunan=$promo->turunan;
        $notif->status='active';
        $notif->perevisi=Auth::user()->id;
        $notif->save();

        return redirect::route('promo4',['id_pkp_promo'=> $promo->id_pkp_promoo,'revisi' => $promo->revisi,'turunan' => $promo->turunan])->with('status', 'Revised Data ');
    }

    function postSave( Request $request)
    {
        $rules = array(
        ); 
        
        $validator = Validator::make($request->all(), $rules);  
        if ($validator->passes()) {
        $idz = implode(",", $request->input('sku'));
        $ids = explode(",", $idz);
        $tgz = implode(",", $request->input('pcs'));
        $tgs = explode(",", $tgz);
        $tga = implode(",", $request->input('remarks'));
        $tgb = explode(",", $tga);
        $sta = implode(",", $request->input('start'));
        $stb = explode(",", $sta);
        $enda = implode(",", $request->input('end'));
        $endb = explode(",", $enda);
        $rto = implode(",", $request->input('rto'));
        $rtoo = explode(",", $rto);
        $opsi = implode(",", $request->input('opsi'));
        $opsi1 = explode(",", $opsi);
        for ($i = 0; $i < count($ids); $i++)
        {
            $pipeline = new product_allocation;
            $pipeline->id_pkp_promo=$request->promo;
            $pipeline->turunan=$request->turunan;
            $pipeline->revisi=$request->revisi;
            $pipeline->opsi=$opsi1[$i];
            $pipeline->product_sku = $ids[$i];
            $pipeline->allocation = $tgs[$i];
            $pipeline->remarks = $tgb[$i];
            $pipeline->start = $stb[$i];
            $pipeline->end = $endb[$i];
            $pipeline->rto = $rtoo[$i];
            $pipeline->save();
            $i = $i++;

        }
        return redirect::Route('uploadpkppromo',['id_pkp_promo'=> $pipeline->id_pkp_promo,'revisi' => $pipeline->revisi,'turunan' => $pipeline->turunan]);
        }
    }

    public function edit(Request $request, $id_pkp_promo,$revisi,$turunan){
        $data = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->tujuankirim=$request->kirim;
        $data->tujuankirim2=$request->rka;
        $data->prioritas=$request->prioritas;
        $data->promo_number=$request->nopromo;
        $data->ket_no=$request->ket_no;
        $data->status_project='sent';
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->status='active';
        $data->save();

        $promo = data_promo::where([ ['id_pkp_promoo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $promo->status_promo='sent';
        $promo->save();

        return redirect::Route('listpromo');
    }

    public function sentpromo(Request $request, $id_pkp_promo,$revisi,$turunan){
        $data = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->tujuankirim=$request->kirim;
        $data->tujuankirim2=$request->rka;
        $data->prioritas=$request->prioritas;
        $data->promo_number=$request->nopromo;
        $data->ket_no=$request->ket_no;
        $data->status_project='sent';
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->status='active';
        $data->save();

        $promo = data_promo::where([ ['id_pkp_promoo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $promo->status_promo='sent';
        $promo->save();

        $pengajuan = pengajuan::where('id_promo',$id_pkp_promo)->first();
        $pengajuan->delete();

        return redirect::Route('listpromo');
    }

    public function edituser(Request $request, $id_pkp_promo){
        $edit = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $edit->userpenerima=$request->user;
        $edit->userpenerima2=$request->user2;
        $edit->status_project='proses';
        $edit->save();
        return redirect::Route('listpromoo');
    }

    public function upversionpromo($id_pkp_promo,$revisi,$turunan){
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $naikversi = $promo->revisi + 1;

        $project = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $project->status_terima='proses';
        $project->status_terima2='proses';
        $project->tgl_terima=null;
        $project->tgl_terima2=null;
        $project->save();

        $datapromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $datapromo->status_data='inactive';
        $datapromo->save();

        $clf=data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($clf>0){
            $isipromo=data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach ($isipromo as $promoo)
            {
                $ppromo = new data_promo;
                $ppromo->id_pkp_promoo=$promoo->id_pkp_promoo;
                $ppromo->promo_idea=$promoo->promo_idea;
                $ppromo->dimension=$promoo->dimension;
                $ppromo->application=$promoo->application;
                $ppromo->promo_readiness=$promoo->promo_readiness;
                $ppromo->rto=$promoo->rto;
                $ppromo->status_promo='revisi';
                $ppromo->status_data='active';
                $ppromo->turunan=$promoo->turunan;
                $ppromo->revisi=$naikversi;
                $ppromo->gambaran_proses=$promoo->gambaran_proses;
                $ppromo->save();
            }
        }
        $allocation = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($allocation>0){
            $isiallocation = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach($isiallocation as $all)
            {
                $al= new product_allocation;
                $al->id_pkp_promo=$all->id_pkp_promo;
                $al->product_sku=$all->product_sku;
                $al->allocation=$all->allocation;
                $al->remarks=$all->remarks;
                $al->start=$all->start;
                $al->end=$all->end;
                $al->turunan=$all->turunan;
                $al->revisi=$all->revisi+1;
                $al->rto=$all->rto;
                $al->opsi=$all->opsi;
                $al->save();
            }
        }
        return Redirect::Route('promo11',['id_pkp_promo'=> $ppromo->id_pkp_promoo,'revisi' => $naikversi,'turunan' => $ppromo->turunan]);
    }

    public function kalenderpromo($id_pkp_promo)
    {
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $events = [];
        $data = promo::where('id_pkp_promo',$id_pkp_promo)->get();
            if($data->count()){
            foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                $value->project_name,
                true,
                new \DateTime($value->jangka),
                new \DateTime($value->waktu.' +1 day')
            );
          }
       }
      $calendar = Calendar::addEvents($events); 
      return view('promo.kalenderpromo')->with([
        'pesan' => $pesan,
        'notif' =>$notif,
        'pengajuan' => $pengajuan,
        'hitungnotif' => $hitungnotif,
        'calendar' => $calendar
    ]);
    }
  
}