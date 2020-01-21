<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\pkp\pkp_type;
use App\pkp\pkp_project;
use App\pkp\project_pdf;
use App\pkp\pkp_uniq_idea;
use App\pkp\uom;
use App\pkp\data_ses;
use Carbon\Carbon;
use App\pkp\ses;
use App\pkp\pkp_estimasi_market;
use App\master\Brand;
use App\pkp\menu;
use App\notification;
use App\nutfact\mikroba;
use App\pkp\jenismenu;
use App\master\Tarkon;
use App\pkp\data_uom;
use App\pkp\promo;
use App\kemas\datakemas;
use App\pkp\data_promo;
use App\nutfact\datapangan;
use App\pkp\coba;
use App\pkp\klaim;
use App\pkp\detail_klaim;
use App\pkp\komponen;
use App\pkp\data_klaim;
use App\pkp\data_detail_klaim;
use App\pkp\komponen_klaim;
use App\pkp\tipp;
use App\nutfact\pangan;
use App\manager\pengajuan;
use App\pkp\picture;
use App\pkp\data_forecast;
use App\users\Departement;
use Auth;
use DB;
use Charts;
use Calendar;
use Redirect;

class pkpController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_global' || 'rule:pv_lokal' || 'rule:NR' || 'rule:marketing' || 'rule:manager');
    }

    public function datapkp(Request $request){
        $pkp = new pkp_project;
        $pkp->id_brand=$request->brand;
        $pkp->author=$request->author;
        $pkp->created_date=$request->last;
        $pkp->project_name=$request->name;
        $pkp->type=$request->type;
        $pkp->jenis=$request->jenis;
        $pkp->save();

        return Redirect()->Route('rekappkp',$pkp->id_project);
    }

    public function formpkp(){
        $type = pkp_type::all();
        $brand = brand::all();
        $menu = jenismenu::all();
        $pkp= pkp_project::count();
        $idea = pkp_uniq_idea::all();
        $pkp1 = pkp_project::where('status_project','!=','draf')->get();
        $market = pkp_estimasi_market::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;

        return view('pkp.requestPKP')->with([
            'type' => $type,
            'market' => $market,
            'idea' => $idea,
            'brand' => $brand,
            'pkp1' => $pkp1,
            'pkp' => $pkp,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'menu' => $menu
        ]);
    }

    public function drafpkp(){
        $pkp1 = pkp_project::where('status_project','!=','draf')->get();
        $pkp = pkp_project::all()->sortByDesc('created_date');
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $jmenu = jenismenu::all();
        $hitung = pkp_project::where('status_project','=','sent')->where('status_project','=','close')->count();
        return view('pkp.drafpkp')->with([
            'pkp' => $pkp,
            'pkp1' => $pkp1,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'jmenu' => $jmenu,
            'hitung' => $hitung
        ]);
    }

    public function hapuspkp($id_project){
        $pkp= pkp_project::where('id_project',$id_project)->first();
        $pkp->delete();

        $Dpkp= tipp::where('id_pkp',$id_project)->first();
        if($Dpkp!=NULL){
        $Dpkp->delete();
        }

        $story= notification::where('id_pkp',$id_project)->first();
        if($story!=NULL){
            $story->delete();
        }

        return redirect::back();
    }

    public function lihatpkp($id_project,$revisi,$turunan){
        $pengajuanpkp = pkp_project::join('pkp_pengajuan','pkp_project.id_project','=','pkp_pengajuan.id_pkp')->count();
        $datapkp = tipp::where('id_pkp',$id_project)->count();
        $nopkp = DB::table('pkp_project')->max('pkp_number')+1;
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $for = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $dataklaim = data_klaim::where('id_pkp',$id_project)->join('klaim','klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pkpp = tipp::join('pkp_project','tippu.id_pkp','=','pkp_project.id_project')->where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $ses= data_ses::where([ ['id_pkp',$id_project], ['revisi','<=',$revisi], ['turunan','<=',$turunan] ])->orderBy('revisi','desc')->orderBy('turunan','desc')->get();
        $uom= data_uom::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $pkp2 = tipp::where('id_pkp',$id_project)->where('revisi','<=',$revisi)->where('turunan',$max)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $pkp1 = tipp::where('id_pkp',$id_project)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $datadetail = data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $user = DB::table('users')->join('pdf_project','pdf_project.tujuankirim','=','users.departement_id')->join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where([ ['pdf_id',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $picture = picture::where('pkp_id',$id_project)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        $dept = Departement::all();
        $dept1 = Departement::all();
        return view('pkp.lihatpkp')->with([
            'pkpp' => $pkpp,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'pkp' => $pkp,
            'datases' => $ses,
            'datauom' => $uom,
            'for' => $for,
            'datadetail' => $datadetail,
            'dataklaim' => $dataklaim,
            'pkp2' => $pkp2,
            'pkp1' => $pkp1,
            'pengajuanpkp' => $pengajuanpkp,
            'user' => $user,
            'datapkp' => $datapkp,
            'nopkp' => substr("T00".$nopkp,1,3),
            'picture' => $picture,
            'dept' => $dept,
            'dept1' => $dept1
        ]); 
    }

    public function downloadpkp($id_project,$revisi,$turunan){
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $pkpp = tipp::join('pkp_project','tippu.id_pkp','=','pkp_project.id_project')->where([ ['id_project',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $picture = picture::where('pkp_id',$id_project)->get();
        $dept = Departement::all();
        $for = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $max2 = tipp::where('id_pkp',$id_project)->max('revisi');
        $pkp1 = tipp::where('id_pkp',$id_project)->where('revisi',$max2)->where('turunan',$turunan)->get();
        $pengajuan = pengajuan::count();
        $notif = notification::count();
        $hitungnotif = $pengajuan + $notif;
        $dataklaim = data_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $ses= data_ses::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $uom= data_uom::where([  ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $datadetail = data_detail_klaim::where('id_pkp',$id_project)->where('turunan',$turunan)->get();
        return view('pkp.downloadpkp')->with([
            'pkpp' => $pkpp,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'datadetail' => $datadetail,
            'pkp1' => $pkp1,
            'dataklaim' => $dataklaim,
            'datases' => $ses,
            'for' => $for,
            'datauom' => $uom,
            'pkp' => $pkp,
            'picture' => $picture
        ]); 
    }

    public function freeze(Request $request,$id_project){
        $data = pkp_project::where('id_project',$id_project)->first();
        $data->status_freeze='active';
        $data->freeze=Auth::user()->id;
        $data->waktu_freeze=Carbon::now();
        $data->note_freeze=$request->notefreeze;
        $data->save();

        return redirect::back()->with('status', 'Project '.$data->project_name.' has been disabled!');
    }

    public function ubahTMpkp(Request $request,$id_project){
        $data= pkp_project::where('id_project',$id_project)->first();
        $data->status_project='revisi';
        $data->save();

        $pengajuan= new pengajuan;
        $pengajuan->prioritas_pengajuan=1;
        $pengajuan->id_pkp=$request->pkp;
        $pengajuan->penerima='14';
        $pengajuan->alasan_pengajuan=$request->lamafreeze;
        $pengajuan->save();

        return redirect::back();
    }

    public function activepkp($id_project){
        $data= pkp_project::where('id_project',$id_project)->first();
        $data->status_freeze='inactive';
        $data->save();

        return redirect::back();
    }

    public function TMubah(Request $request,$id_project){
        $data= pkp_project::where('id_project',$id_project)->first();
        $data->status_project='sent';
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->status_freeze='inactive';
        $data->freeze_diaktifkan=Carbon::now();
        $data->save();

        $pengajuan = pengajuan::where('id_pkp',$id_project)->first();
        $pengajuan->delete();

        return redirect::back();
    }

    public function terima(Request $request, $id_project){
        $terima= pkp_project::where('id_project',$id_project)->first();
        $terima->project_status=$request->terima;
        $terima->save();
        
        return Redirect()->back()->with('status', 'PKP '.$pkp->name.' Telah Ditambahkan!');
    }

    public function listpkp(){
        $pkp = pkp_project::all();
        $type = pkp_type::all();
        $brand = brand::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('pkp.listpkp')->with([
            'type' => $type,
            'brand' => $brand,
            'pkp' => $pkp,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function konfigurasi($id_project,$turunan){
        $konfig = tipp::where([ ['id_pkp',$id_project], ['turunan',$turunan] ])->first();
        $konfig->kemas_eksis=null;
        $konfig->save();
        return redirect::back();
    }

    public function buatpkp($id_project,$revisi,$turunan){
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $pkpdata = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $project = tipp::where('status_pkp','!=','draf')->where('status_data','=','active') ->join('pkp_project','pkp_project.id_project','=','tippu.id_pkp')->get();
        $brand = brand::all();
        $ses = ses::all();
        $datases = data_ses::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $uom = uom::all();
        $Ddetail = data_detail_klaim::max('id')+1;
        $tarkon = Tarkon::all();
        $for = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $for2 = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        $kemas = datakemas::all();
        $eksis=datakemas::count();
        $datadetail = data_detail_klaim::where('id_pkp',$id_project)->where('turunan',$turunan)->where('revisi',$revisi)->get();
        $pangan = pangan::all();
        $datapangan = datapangan::all();
        $hitung = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->count();
        $id_pkp = pkp_project::find($id_project);
        $idea = pkp_uniq_idea::all();
        $dataklaim = data_klaim::where('id_pkp',$id_project)->where('turunan',$turunan)->where('revisi',$revisi)->get();
        $ide = pkp_uniq_idea::all();
        $market = pkp_estimasi_market::all();
        $mar = pkp_estimasi_market::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $detail = detail_klaim::all();
        $klaim = klaim::all();
        $komponen = komponen::all();
        return view('pkp.buatpkp')->with([
            'brand' => $brand,
            'for2' => $for2,
            'datadetail' => $datadetail,
            'for' => $for,
            'datapangan' => $datapangan,
            'hitung' => $hitung,
            'uom' => $uom,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'datases' => $datases,
            'ses' => $ses,
            'tarkon' => $tarkon,
            'dataklaim' => $dataklaim,
            'eksis' => $eksis,
            'project' => $project,
            'Ddetail' => $Ddetail,
            'pangan' => $pangan,
            'kemas' => $kemas,
            'id_pkp' => $id_pkp,
            'idea' => $idea,
            'pkp' => $pkp,
            'ide' => $ide,
            'komponen' => $komponen,
            'klaim' => $klaim,
            'detail' => $detail,
            'mar' => $mar,
            'pkpdata' => $pkpdata,
            'market' => $market
        ]);
    }

    public function buatpkp1($id_project){
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $brand = brand::all();
        $tarkon = Tarkon::all();
        $pangan = pangan::all();
        $kemas = datakemas::get();
        $uom = uom::all();
        $ses = ses::all();
        $Ddetail = data_detail_klaim::max('id')+1;
        $detail = detail_klaim::all();
        $klaim = klaim::all();
        $komponen = komponen::all();
        $datapangan = datapangan::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $id_pkp = pkp_project::find($id_project);
        $idea = pkp_uniq_idea::all();
        $project = tipp::where('status_pkp','!=','draf')->where('status_data','=','active') ->join('pkp_project','pkp_project.id_project','=','tippu.id_pkp')->get();
        $eksis=datakemas::count();
        $ide = pkp_uniq_idea::all();
        $market = pkp_estimasi_market::all();
        $mar = pkp_estimasi_market::all();
        return view('pkp.buatpkp1')->with([
            'brand' => $brand,
            'project' => $project,
            'komponen' => $komponen,
            'klaim' => $klaim,
            'detail' => $detail,
            'datapangan' => $datapangan,
            'tarkon' => $tarkon,
            'pangan' => $pangan,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'id_pkp' => $id_pkp,
            'idea' => $idea,
            'ses' => $ses,
            'Ddetail' => $Ddetail,
            'uom' => $uom,
            'pkp' => $pkp,
            'eksis' => $eksis,
            'kemas' => $kemas,
            'ide' => $ide,
            'mar' => $mar,
            'market' => $market
        ]);
    }

    public function updatetipp(Request $request,$id_project,$revisi,$turunan){
        $pkp = tipp::where('id_pkp',$id_project)->max('turunan');
        $naikversi = $pkp + 1;

        $data = tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$pkp)->first();
        $data->status_data='inactive';
        $data->save();

            $clf=tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($clf>0){
                $isipkp=tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isipkp as $pkpp)
                {
                $tip= new tipp;
                $tip->id_pkp=$pkpp->id_pkp;
                $tip->idea=$request->idea;
                $tip->gender=$request->gender;
                $tip->dariumur=$request->dariumur;
                $tip->sampaiumur=$request->sampaiumur;
                $tip->Uniqueness=$request->uniq_idea;
                $tip->reason=$request->reason;
                $tip->Estimated=$request->estimated;
                $tip->launch=$request->launch;
                $tip->kemas_eksis=$request->eksis;
                $tip->years=$request->tahun;
                $tip->tgl_launch=$request->tanggal;
                $tip->competitive=$request->competitive;
                $tip->selling_price=$request->Selling_price;
                $tip->competitor=$request->competitor;
                $tip->aisle=$request->aisle;
                $tip->price=$request->analysis;
                $tip->product_form=$request->product;
                $tip->bpom=$request->bpom;
                $tip->kategori_bpom=$request->katbpom;
                $tip->akg=$request->akg;
                if($request->primer==''){
                    $tip->kemas_eksis=$request->data_eksis;
                    }elseif($request->primer!='NULL'){
                    $tip->kemas_eksis=$request->kemas;

                        $kemas = new datakemas;
                        $kemas->tersier=$request->tersier;
                        $kemas->s_tersier=$request->s_tersier;
                        $kemas->primer=$request->primer;
                        $kemas->s_primer=$request->s_primer;
                        $kemas->sekunder1=$request->sekunder1;
                        $kemas->s_sekunder1=$request->s_sekunder1;
                        $kemas->sekunder2=$request->sekunder2;
                        $kemas->s_sekunder2=$request->s_sekunder2;
                        $kemas->save();
                    }
                $tip->primery=$request->primary;
                $tip->status_data='active';
                $tip->secondary=$request->secondary;
                $tip->tertiary=$request->tertiary;
                $tip->olahan=$request->olahan;
                $tip->turunan=$naikversi;
                $tip->status_data='active';
                $tip->revisi=$pkpp->revisi;
                $tip->prefered_flavour=$request->prefered;
                $tip->product_benefits=$request->benefits;
                $tip->mandatory_ingredient=$request->ingredient;
                $tip->UOM=$request->uom;
                $tip->gambaran_proses=$request->proses;
                $tip->save();
                }
            }

            $notif = notification::where('id_pkp',$id_project)->first();
            $notif->id_pkp=$tip->id_pkp;
            $notif->title="Edit Data PKP";
            $notif->turunan=$tip->turunan;
            $notif->sstatus='active';
            $notif->perevisi=Auth::user()->id;
            $notif->save();

            $datases=data_ses::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($datases>0){
                $isises=data_ses::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isises as $isises)
                {
                    $data1= new data_ses;
                    $data1->id_pkp=$isises->id_pkp;
                    $data1->revisi=$isises->revisi;;
                    $data1->turunan=$naikversi;
                    $data1->ses=$isises->ses;
                    $data1->save();
                }
            }
            $datafor=data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($datafor>0){
                $isifor=data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isifor as $isifor)
                {
                    $for= new data_forecast;
                    $for->id_pkp=$isifor->id_pkp;
                    $for->revisi=$isifor->revisi;
                    $for->turunan=$naikversi;
                    $for->forecast=$isifor->forecast;
                    $for->satuan=$isifor->satuan;
                    $for->save();
                }
            }
            $dataklaim=data_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($dataklaim>0){
                $isiklaim=data_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isiklaim as $isiklaim)
                {
                    $klaim= new data_klaim;
                    $klaim->id_pkp=$isiklaim->id_pkp;
                    $klaim->revisi=$isiklaim->revisi;
                    $klaim->turunan=$naikversi;
                    $klaim->id_komponen=$isiklaim->id_komponen;
                    $klaim->id_klaim=$isiklaim->id_klaim;
                    $klaim->note=$isiklaim->note;
                    $klaim->save();
                }
            }
            $detailklaim=data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($detailklaim>0){
                $isidetail=data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isidetail as $isidetail)
                {
                    $detail= new data_detail_klaim;
                    $detail->id_pkp=$isidetail->id_pkp;
                    $detail->revisi=$isidetail->revisi;
                    $detail->turunan=$naikversi;
                    $detail->id_detail=$isidetail->id_detail;
                    $detail->save();
                }
            }
        return redirect()->Route('datatambahanpkp',['id_project' => $id_project, 'revisi' => $tip->revisi, 'turunan' => $tip->turunan])->with('status', 'Revised data ');
    }

    public function updatetipp2(Request $request,$id_pkp,$revisi,$turunan){
        $eksis = datakemas::count();
        $tip = tipp::where('id_pkp',$id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $tip->idea=$request->idea;
        $tip->gender=$request->gender;
        $tip->dariumur=$request->dariumur;
        $tip->sampaiumur=$request->sampaiumur;
        $tip->Uniqueness=$request->uniq_idea;
        $tip->reason=$request->reason;
        $tip->Estimated=$request->estimated;
        $tip->launch=$request->launch;
        $tip->kemas_eksis=$request->eksis;
        $tip->years=$request->tahun;
        $tip->revisi=$request->revisi;
        $tip->tgl_launch=$request->tanggal;
        $tip->competitive=$request->competitive;
        $tip->selling_price=$request->Selling_price;
        $tip->competitor=$request->competitor;
        $tip->aisle=$request->aisle;
        $tip->price=$request->analysis;
        $tip->product_form=$request->product;
        $tip->bpom=$request->bpom;
        $tip->kategori_bpom=$request->katbpom;
        $tip->akg=$request->akg;
        if($request->primer==''){
            $tip->kemas_eksis=$request->data_eksis;
            }elseif($request->primer!='NULL'){
            $tip->kemas_eksis=$request->kemas;

                $kemas = new datakemas;
                $kemas->tersier=$request->tersier;
                $kemas->s_tersier=$request->s_tersier;
                $kemas->primer=$request->primer;
                $kemas->s_primer=$request->s_primer;
                $kemas->sekunder1=$request->sekunder1;
                $kemas->s_sekunder1=$request->s_sekunder1;
                $kemas->sekunder2=$request->sekunder2;
                $kemas->s_sekunder2=$request->s_sekunder2;
                $kemas->save();
            }
        $tip->primery=$request->primary;
        $tip->status_data='active';
        $tip->secondary=$request->secondary;
        $tip->tertiary=$request->tertiary;
        $tip->olahan=$request->olahan;
        $tip->prefered_flavour=$request->prefered;
        $tip->product_benefits=$request->benefits;
        $tip->mandatory_ingredient=$request->ingredient;
        $tip->UOM=$request->uom;
        $tip->gambaran_proses=$request->proses;
        $tip->save();

        $notif = notification::where('id_pkp',$id_project)->first();
        $notif->id_pkp=$tip->id_pkp;
        $notif->title="Edit Data PKP";
        $notif->turunan=$tip->turunan;
        $notif->status='active';
        $notif->perevisi=Auth::user()->id;
        $notif->save();

        if($request->ses!=''){
            $rule = array(); 
            $uom = data_ses::where([ ['id_pkp',$id_pkp], ['revisi',$revisi], ['turunan',$turunan] ])->delete();
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
            $idz = implode(',', $request->input('ses'));
            $ids = explode(',', $idz);
            for ($i = 0; $i < count($ids); $i++)
            {
                $pipeline = new data_ses;
                $pipeline->id_pkp=$request->id;
                $pipeline->turunan=$turunan;
                $pipeline->revisi=$revisi;
                $pipeline->ses = $ids[$i];
                $pipeline->save();
                $i = $i++;
            }
        }
        }

        if($request->satuan!=''){
            $data = array(); 
            $for = data_forecast::where('id_pkp',$id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->delete();
            $validator = Validator::make($request->all(), $data);  
            if ($validator->passes()) {
            $idz = implode(',', $request->input('forecast'));
            $ids = explode(',', $idz);
            $ida = implode(',', $request->input('satuan'));
            $idb = explode(',', $ida);
            for ($i = 0; $i < count($ids); $i++)
            {
                $pipeline = new data_forecast;
                $pipeline->id_pkp=$request->id;
                $pipeline->turunan=$turunan;
                $pipeline->revisi=$revisi;
                $pipeline->forecast = $ids[$i];
                $pipeline->satuan = $idb[$i];
                $pipeline->save();
                $i = $i++;
            }
        }
        }

        if($request->klaim!=''){
            $dataklaim = array(); 
            $dk = data_klaim::where('id_pkp',$id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->delete();
            $validator = Validator::make($request->all(), $dataklaim);  
            if ($validator->passes()) {
            $idz = implode(',', $request->input('klaim'));
            $ids = explode(',', $idz);
            $ida = implode(',', $request->input('komponen'));
            $idb = explode(',', $ida);
            $note = implode(',', $request->input('ket'));
            $data = explode(',', $note);
            for ($i = 0; $i < count($ids); $i++)
            {
                $pipeline = new data_klaim;
                $pipeline->id_pkp=$request->id;
                $pipeline->turunan=$turunan;
                $pipeline->revisi=$revisi;
                $pipeline->id_klaim = $ids[$i];
                $pipeline->id_komponen = $idb[$i];
                $pipeline->note = $data[$i];
                $pipeline->save();
                $i = $i++;
            }
        }
        }

        if($request->detail!=''){
        $detailklaim = array(); 
        $ddk = data_detail_klaim::where('id_pkp',$id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->delete();
        $validator = Validator::make($request->all(), $detailklaim);  
        if ($validator->passes()) {
        $idz = implode(',', $request->input('detail'));
        $ids = explode(',', $idz);
        for ($i = 0; $i < count($ids); $i++)
        {
            $detail = new data_detail_klaim;
            $detail->id_pkp=$request->id;
            $pipeline->turunan=$turunan;
            $pipeline->revisi=$revisi;
            $detail->id_detail = $ids[$i];
            $detail->save();
            $i = $i++;

        }
        }
    }

        return redirect()->Route('datatambahanpkp',['id_project' => $tip->id_pkp, 'revisi' => $tip->revisi, 'turunan' => $tip->turunan])->with('status', 'Revised data ');
    }

    public function tipp(Request $request){
        $tip = new tipp;
        $tip->id_pkp=$request->id;
        $tip->idea=$request->idea;
        $tip->gender=$request->gender;
        $tip->dariumur=$request->dariumur;
        $tip->sampaiumur=$request->sampaiumur;
        $tip->Uniqueness=$request->uniq_idea;
        $tip->reason=$request->reason;
        $tip->Estimated=$request->estimated;
        $tip->launch=$request->launch;
        $tip->years=$request->tahun;
        $tip->tgl_launch=$request->tanggal;
        $tip->competitive=$request->Competitive;
        $tip->UOM=$request->uom;
        $tip->revisi='0';
        $tip->selling_price=$request->Selling_price;
        $tip->competitor=$request->competitor;
        $tip->aisle=$request->aisle;
        $tip->price=$request->consumer_price;
        if($request->primer==''){
            $tip->kemas_eksis=$request->data_eksis;
            }elseif($request->primer!='NULL'){
            $tip->kemas_eksis=$request->kemas;

                $kemas = new datakemas;
                $kemas->tersier=$request->tersier;
                $kemas->s_tersier=$request->s_tersier;
                $kemas->primer=$request->primer;
                $kemas->s_primer=$request->s_primer;
                $kemas->sekunder1=$request->sekunder1;
                $kemas->s_sekunder1=$request->s_sekunder1;
                $kemas->sekunder2=$request->sekunder2;
                $kemas->s_sekunder2=$request->s_sekunder2;
                $kemas->save();
            }
        $tip->product_form=$request->product;
        $tip->bpom=$request->bpom;
        $tip->kategori_bpom=$request->katbpom;
        $tip->akg=$request->akg;
        $tip->olahan=$request->olahan;
        $tip->turunan='0';
        $tip->primery=$request->primary;
        $tip->secondary=$request->secondary;
        $tip->tertiary=$request->tertiary;
        $tip->prefered_flavour=$request->prefered;
        $tip->product_benefits=$request->benefits;
        $tip->mandatory_ingredient=$request->ingredient;
        $tip->gambaran_proses=$request->proses;
        $tip->save();

        $notif = new notification;
        $notif->id_pkp=$tip->id_pkp;
        $notif->title="Add Data PKP";
        $notif->turunan=$tip->turunan;
         $notif->perevisi=Auth::user()->id;
        $notif->save();
    
        if($request->ses!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
            $idz = implode(',', $request->input('ses'));
            $ids = explode(',', $idz);
            for ($i = 0; $i < count($ids); $i++)
            {
                $pipeline = new data_ses;
                $pipeline->id_pkp=$request->id;
                $pipeline->turunan='0';
                $pipeline->ses = $ids[$i];
                $pipeline->save();
                $i = $i++;
            }
        }
        }

        if($request->forecast!='' && $request->satuan!=''){
            $data = array(); 
            $validator = Validator::make($request->all(), $data);  
            if ($validator->passes()) {
            $idz = implode(',', $request->input('forecast'));
            $ids = explode(',', $idz);
            $ida = implode(',', $request->input('satuan'));
            $idb = explode(',', $ida);
            for ($i = 0; $i < count($ids); $i++)
            {
                $pipeline = new data_forecast;
                $pipeline->id_pkp=$request->id;
                $pipeline->turunan='0';
                $pipeline->forecast = $ids[$i];
                $pipeline->satuan = $idb[$i];
                $pipeline->save();
                $i = $i++;
            }
        }
        }

        if($request->klaim!=''){
            $dataklaim = array(); 
            $validator = Validator::make($request->all(), $dataklaim);  
            if ($validator->passes()) {
            $idz = implode(',', $request->input('klaim'));
            $ids = explode(',', $idz);
            $ida = implode(',', $request->input('komponen'));
            $idb = explode(',', $ida);
            $note = implode(',', $request->input('ket'));
            $data = explode(',', $note);
            for ($i = 0; $i < count($ids); $i++)
            {
                $pipeline = new data_klaim;
                $pipeline->id_pkp=$request->id;
                $pipeline->turunan='0';
                $pipeline->id_klaim = $ids[$i];
                $pipeline->id_komponen = $idb[$i];
                $pipeline->note= $data[$i];
                $pipeline->save();
                $i = $i++;
            }
        }
        }

        if($request->detail!=''){
            $detailklaim = array(); 
            $validator = Validator::make($request->all(), $detailklaim);  
            if ($validator->passes()) {
            $idz = implode(',', $request->input('detail'));
            $ids = explode(',', $idz);
            for ($i = 0; $i < count($ids); $i++)
            {
                $detail = new data_detail_klaim;
                $detail->id_pkp=$request->id;
                $detail->id_klaim=$request->iddetail;
                $detail->turunan='0';
                $detail->id_detail = $ids[$i];
                $detail->save();
                $i = $i++;
            }
        }
        }
        return redirect()->Route('datatambahanpkp',['id_pkp' => $tip->id_pkp,'revisi' => $tip->revisi, 'turunan' => $tip->turunan])->with('status', 'Data has been added up ');
    }

    public function step1($id_project,$revisi,$turunan){
        $pkp = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $data = tipp::where('turunan',$turunan)->get();
        $brand = brand::all();
        $typemenu = jenismenu::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('pkp.step1')->with([
            'pkp' => $pkp,
            'brand' => $brand,
            'data' => $data,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'type' => $typemenu
        ]);

    }

    public function step2($id_project){
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $typemenu = jenismenu::all();
        $brand = brand::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('pkp.step2')->with([
            'pkp' => $pkp,
            'brand' => $brand,
            'type' => $typemenu,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);

    }

    public function updatest1(Request $request, $id_project,$revisi,$turunan){
        $pkp= pkp_project::where('id_project',$id_project)->first();
        $pkp->perevisi=$request->perevisi;
        $pkp->last_update=$request->last_up;
        $pkp->project_name=$request->name;
        $pkp->id_brand=$request->brand;
        $pkp->jenis=$request->jenis;
        $pkp->save();

        return redirect()->route('buatpkp',['id_project'=>$pkp->id_project, 'revisi' => $revisi, 'turunan' => $turunan]);
    }

    public function updatest2(Request $request, $id_project){
        $pkp= pkp_project::where('id_project',$id_project)->first();
        $pkp->perevisi=$request->perevisi;
        $pkp->last_update=$request->last_up;
        $pkp->jenis=$request->jenis;
        $pkp->project_name=$request->name;
        $pkp->save();

        return redirect()->route('buatpkp1',$pkp->id_project);
    }

    public function uploadpkp($id_project,$revisi,$turunan){
        $pkp= pkp_project::where('id_project',$id_project)->get();
        $coba = picture::where('pkp_id',$id_project)->where('turunan','<=',$turunan)->get();
        $id_pkp= pkp_project::find($id_project);
        $turunan= tipp::where([ ['id_pkp',$id_project], ['turunan',$turunan] ])->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('pkp.datatambahanpkp')->with([
            'pkp' => $pkp,
            'coba' => $coba,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'turunan' => $turunan,
            'id_pkp' => $id_pkp
        ]);
    }

    public function uploaddatapkp(Request $request){
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'required|file|max:5120'
        ]);
        $files = [];
        foreach ($request->file('filename') as $file) {
        if ($file->isValid()) {
            $path = $file->store('public/storage');
            $turunan =$request->turunan;
            $form=$request->id;
            $files[] = [
                'filename' => $file->getClientOriginalName(),
                'lokasi' => $path,
                'pkp_id' => $form,
                'turunan' => $turunan,
            ];
            }
        }
        picture::insert($files);
        return redirect()->back()->withSuccess(sprintf('%s file uploaded successfully.', count($files)));
    }

    public function destroydata($id_pictures){
        $data = picture::find($id_pictures);
        $data->delete();
        return redirect::back()->with('status', 'Workbook ');
    }

    public function edit(Request $request, $id_project){

        $data = pkp_project::where('id_project',$id_project)->first();
        $data->prioritas=$request->prioritas;
        $data->pkp_number=$request->nopkp;
        $data->ket_no=$request->ket_no;
        $data->status_project='sent';
        $data->tujuankirim=$request->kirim;
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->tujuankirim2=$request->rka;
        $data->status='active';
        $data->save();

        $isi = tipp::where('id_pkp',$id_project)->update([
            "status_pkp" => 'sent'
        ]);
       
        return redirect::Route('listpkp');
    }

    public function sentpkp(Request $request, $id_project,$revisi,$turunan){
        $data = pkp_project::where('id_project',$id_project)->first();
        $data->prioritas=$request->prioritas;
        $data->pkp_number=$request->nopkp;
        $data->ket_no=$request->ket_no;
        $data->status_project='sent';
        $data->tujuankirim=$request->kirim;
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->tujuankirim2=$request->rka;
        $data->status='active';
        $data->save();
        
        $isi = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $isi->status_pkp='sent';
        $isi->save();

        $pengajuan = pengajuan::where('id_pkp',$id_project)->first();
        $pengajuan->delete();
               
        return redirect::Route('listpkp');
    }

    public function edituser(Request $request, $id_project){
        $edit = pkp_project::where('id_project',$id_project)->first();
        $edit->userpenerima=$request->user;
        $edit->userpenerima2=$request->user2;
        $edit->status_project='proses';
        $edit->save();
        return redirect::Route('listpkprka');
    }

    public function downloadfile($filename){
        $url = Storage::disk('public')->url('$filename');
        return response()->download(storage_path("app/public/{$filename}"));
    }

    public function rekappkp($id_project){
        $pengajuanpkp = pkp_project::join('pkp_pengajuan','pkp_project.id_project','=','pkp_pengajuan.id_pkp')->count();
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $hitung = tipp::where('id_pkp',$id_project)->count();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $max2 = tipp::where('id_pkp',$id_project)->max('revisi');
        $datapkp = tipp::where('id_pkp',$id_project)->where('turunan',$max)->where('revisi',$max2)->get();
        $pkp1 = pkp_project::where('id_project',$id_project)->get();
        $data = pkp_project::where('id_project',$id_project)->get();
        return view('pkp.daftarpkp')->with([
            'pkp' => $pkp,
            'pkp1' => $pkp1,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'datapkp' => $datapkp,
            'pengajuanpkp' => $pengajuanpkp,
            'data' => $data,
            'hitung' => $hitung
        ]);
    }

    public function approve1(Request $request,$id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->status_terima='terima';
        $pkp->tgl_terima=$request->tgl;
        $pkp->save();

        return redirect::back();
    }

    public function approve2(Request $request,$id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->status_terima2='terima';
        $pkp->tgl_terima2=$request->tgl;
        $pkp->save();

        return redirect::back();
    }

    public function edittype(Request $request, $id_project){
        $type = pkp_project::where('id_project',$id_project)->first();
        $type->type=$request->type;
        $type->save();

        $turunan = tipp::max('turunan');
        $pkp = tipp::where('id_pkp',$id_project)->where('turunan',$turunan)->first();
        $pkp->gambaran_proses=NULL;
        $pkp->save();

        return redirect::back();
    }

    public function export_pdf($id_project){
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $pkpp = DB::table('pkp_project') ->join('tippu','tippu.id_pkp','=','pkp_project.id_project') ->where('id_project',$id_project)->get();
        $picture = picture::where('pkp_id',$id_project)->get();
        $dept = Departement::all();
        $data = ['pkpp' => $pkpp,
        'pkp' => $pkp,
        'picture' => $picture,
        'dept' => $dept];
        $pdf = PDF::loadView('pkp.downloadpkp', $data);
        return $pdf->download('laporan-pdf.pdf');
    }

    public function dasboardpv(){
        $hitungpkp = pkp_project::where('status_project','=','draf')->count();
        $pkp1 = pkp_project::all()->count();
        $hitungpromo = promo::where('status_project','=','draf')->count();
        $promo1 = promo::all()->count();
        $hitungpdf = project_pdf::where('status_project','=','draf')->count();
        $pdf1 = project_pdf::all()->count();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $revisi = pkp_project::where('status_project','=','revisi')->count();
        $proses = pkp_project::where('status_project','=','proses')->count();
        $sent= pkp_project::where('status_project','=','sent')->count();
        $close = pkp_project::where('status_project','=','close')->count();
        $pie  =	 Charts::create('bar', 'highcharts')->title('Data PKP')->colors(['#ff0000', '#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
            ->values([$hitungpkp,$sent,$revisi,$proses,$close])->responsive(false);
        $revisipdf = project_pdf::where('status_project','=','revisi')->count();
        $prosespdf = project_pdf::where('status_project','=','proses')->count();
        $sentpdf= project_pdf::where('status_project','=','sent')->count();
        $closepdf = project_pdf::where('status_project','=','close')->count();
        $pie2  =	 Charts::create('pie', 'highcharts')->title('Data PDF')->colors(['#ff0000', '#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
            ->values([$hitungpdf,$sentpdf,$revisipdf,$prosespdf,$closepdf])->responsive(false);
        $revisipromo = promo::where('status_project','=','revisi')->count();
        $prosespromo = promo::where('status_project','=','proses')->count();
        $sentpromo = promo::where('status_project','=','sent')->count();
        $closepromo = promo::where('status_project','=','close')->count();
        $pie3  =	 Charts::create('area', 'highcharts')->title('Data PKP Promo')->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
			->values([$hitungpromo,$sentpromo,$revisipromo,$prosespromo,$closepromo])->responsive(false);
        return view('pv.dasboard')->with([
            'hitungpkp' => $hitungpkp,
            'pkp1' => $pkp1,
            'hitungpromo' => $hitungpromo,
            'promo1' => $promo1,
            'hitungpdf' => $hitungpdf,
            'pdf1' => $pdf1,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pie' => $pie,
            'pie2' => $pie2,
            'pie3' => $pie3,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pesan' => $pesan,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function bacapesan($id){
        $pesan = notification::where('id',$id)->first();
        $pesan->status="nonactive";
        $pesan->save();
        
        if($pesan->id_pdf!=NULL){
        return redirect::route('rekappdf',$pesan->id_pdf);
        }
        if($pesan->id_pkp!=NULL){
        return redirect::route('rekappkp',$pesan->id_pkp);  
        }
        if($pesan->id_promo!=NULL){
        return redirect::route('rekappromo',$pesan->id_promo);  
        }
    }
    
    public function hapuspesan($id){
        $pesan = notification::where('id',$id)->first();
        $pesan->delete();

        return redirect::back();
    }

    public function dasboardnr(){
        $pkp1 = pkp_project::all()->count();
        $promo1 = promo::all()->count();
        $pdf1 = project_pdf::all()->count();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $hitungpkp = pkp_project::where('status_project','=','draf')->count();
        $pkp1 = pkp_project::all()->count();
        $hitungpromo = promo::where('status_project','=','draf')->count();
        $promo1 = promo::all()->count();
        $hitungpdf = project_pdf::where('status_project','=','draf')->count();
        $revisi = pkp_project::where('status_project','=','revisi')->count();
        $proses = pkp_project::where('status_project','=','proses')->count();
        $sent= pkp_project::where('status_project','=','sent')->count();
        $close = pkp_project::where('status_project','=','close')->count();
        $pie  =	 Charts::create('bar', 'highcharts')->title('Data PKP')->colors(['#ff0000', '#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
            ->values([$hitungpkp,$sent,$revisi,$proses,$close])->responsive(false);
        $revisipdf = project_pdf::where('status_project','=','revisi')->count();
        $prosespdf = project_pdf::where('status_project','=','proses')->count();
        $sentpdf= project_pdf::where('status_project','=','sent')->count();
        $closepdf = project_pdf::where('status_project','=','close')->count();
        $pie2  =	 Charts::create('pie', 'highcharts')->title('Data PDF')->colors(['#ff0000', '#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
            ->values([$hitungpdf,$sentpdf,$revisipdf,$prosespdf,$closepdf])->responsive(false);
        $revisipromo = promo::where('status_project','=','revisi')->count();
        $prosespromo = promo::where('status_project','=','proses')->count();
        $sentpromo = promo::where('status_project','=','sent')->count();
        $closepromo = promo::where('status_project','=','close')->count();
        $pie3  =	 Charts::create('area', 'highcharts')->title('Data PKP Promo')->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
			->values([$hitungpromo,$sentpromo,$revisipromo,$prosespromo,$closepromo])->responsive(false);
        return view('NR.dasboard')->with([
            'pkp1' => $pkp1,
            'promo1' => $promo1,
            'pie' => $pie,
            'pie2' => $pie2,
            'notif' =>$notif,
            'pesan' => $pesan,
            'pengajuan' => $pengajuan,
            'pie3' => $pie3,
            'hitungnotif' => $hitungnotif,
            'pdf1' => $pdf1
        ]);
    }

    public function dasboardcs(){
        $pkp1 = pkp_project::all()->count();
        $hitungpkp = pkp_project::where('status_project','=','draf')->count();
        $promo1 = promo::all()->count();
        $pdf1 = project_pdf::all()->count();
        $pengajuan = pengajuan::count();
        $pkp1 = pkp_project::all()->count();
        $hitungpromo = promo::where('status_project','=','draf')->count();
        $promo1 = promo::all()->count();
        $hitungpdf = project_pdf::where('status_project','=','draf')->count();
        $pdf1 = project_pdf::all()->count();
        $revisipromo = promo::where('status_project','=','revisi')->count();
        $prosespromo = promo::where('status_project','=','proses')->count();
        $sentpromo = promo::where('status_project','=','sent')->count();
        $closepromo = promo::where('status_project','=','close')->count();
        $pie3  =	 Charts::create('area', 'highcharts')->title('Data PKP Promo')->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
			->values([$hitungpromo,$sentpromo,$revisipromo,$prosespromo,$closepromo])->responsive(false);
        return view('CS.dasboardcs')->with([
            'pkp1' => $pkp1,
            'promo1' => $promo1,
            'hitungpromo' => $hitungpromo,
            'promo1' => $promo1,
            'hitungpdf' => $hitungpdf,
            'pdf1' => $pdf1,
            'pie3' => $pie3,
            'hitungpkp' => $hitungpkp,
            'pengajuan' => $pengajuan,
            'pdf1' => $pdf1
        ]);
    }

    public function prioritas(Request $request,$id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->prioritas=$request->prioritas;
        $pkp->save();

        return redirect::back();
    }

    public function upversionpkp($id_project,$revisi,$turunan){
        $pkp = tipp::where('id_pkp',$id_project)->max('revisi');
        $naikversi = $pkp + 1;

        $project = pkp_project::where('id_project',$id_project)->first();
        $project->status_project='revisi';
        $project->status_terima='proses';
        $project->status_terima2='proses';
        $project->tgl_terima=null;
        $project->tgl_terima2=null;
        $project->save();

        $data = tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $data->status_data='inactive';
        $data->status_pkp='revisi';
        $data->save();

            $clf=tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($clf>0){
                $isipkp=tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isipkp as $pkpp)
                {
                $tip= new tipp;
                $tip->id_pkp=$pkpp->id_pkp;
                $tip->idea=$pkpp->idea;
                $tip->gender=$pkpp->gender;
                $tip->dariumur=$pkpp->dariumur;
                $tip->sampaiumur=$pkpp->sampaiumur;
                $tip->Uniqueness=$pkpp->Uniqueness;
                $tip->reason=$pkpp->reason;
                $tip->Estimated=$pkpp->Estimated;
                $tip->launch=$pkpp->launch;
                $tip->years=$pkpp->years;
                $tip->olahan=$pkpp->olahan;
                $tip->revisi=$naikversi;
                $tip->turunan=$pkpp->turunan;
                $tip->tgl_launch=$pkpp->tgl_launch;
                $tip->competitive=$pkpp->competitive;
                $tip->selling_price=$pkpp->selling_price;
                $tip->competitor=$pkpp->competitor;
                $tip->aisle=$pkpp->aisle;
                $tip->product_form=$pkpp->product_form;
                $tip->bpom=$pkpp->bpom;
                $tip->status_data=$pkpp->status_data;
                $tip->kategori_bpom=$pkpp->kategori_bpom;
                $tip->akg=$pkpp->akg;
                $tip->UOM=$pkpp->UOM;
                $tip->price=$pkpp->price;
                $tip->status_pkp='revisi';
                $tip->status_data='active';
                $tip->primery=$pkpp->primery;
                $tip->secondary=$pkpp->secondary;
                $tip->tertiary=$pkpp->tertiary;
                $tip->kemas_eksis=$pkpp->kemas_eksis;
                $tip->prefered_flavour=$pkpp->prefered_flavour;
                $tip->product_benefits=$pkpp->product_benefits;
                $tip->mandatory_ingredient=$pkpp->mandatory_ingredient;
                $tip->gambaran_proses=$pkpp->gambaran_proses;
                $tip->save();
                }
            }
            $datases=data_ses::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($datases>0){
                $isises=data_ses::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isises as $isises)
                {
                    $data1= new data_ses;
                    $data1->id_pkp=$isises->id_pkp;
                    $data1->revisi=$isises->revisi+1;
                    $data1->turunan=$isises->turunan;
                    $data1->ses=$isises->ses;
                    $data1->save();
                }
            }
            $datafor=data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($datafor>0){
                $isifor=data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isifor as $isifor)
                {
                    $for= new data_forecast;
                    $for->id_pkp=$isifor->id_pkp;
                    $for->revisi=$isifor->revisi+1;
                    $for->turunan=$isifor->turunan;
                    $for->forecast=$isifor->forecast;
                    $for->satuan=$isifor->satuan;
                    $for->save();
                }
            }
            $dataklaim=data_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($dataklaim>0){
                $isiklaim=data_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isiklaim as $isiklaim)
                {
                    $klaim= new data_klaim;
                    $klaim->id_pkp=$isiklaim->id_pkp;
                    $klaim->revisi=$naikversi;
                    $klaim->turunan=$isiklaim->turunan;
                    $klaim->id_komponen=$isiklaim->id_komponen;
                    $klaim->id_klaim=$isiklaim->id_klaim;
                    $klaim->save();
                }
            }
            $detailklaim=data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($detailklaim>0){
                $isidetail=data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isidetail as $isidetail)
                {
                    $detail= new data_detail_klaim;
                    $detail->id_pkp=$isidetail->id_pkp;
                    $detail->revisi=$naikversi;
                    $detail->turunan=$isidetail->turunan;
                    $detail->id_detail=$isidetail->id_detail;
                    $detail->save();
                }
            }
            return Redirect::Route('bagian1',['id_pkp'=>$id_project, 'revisi' => $naikversi, 'turunan' => $turunan]);
    }

    public function deletelaunch($id_project,$turunan){
        $data= tipp::where('id_pkp',$id_project)->where('turunan',$turunan)->first();
        $data->launch=null;
        $data->years=null;
        $data->tgl_launch=null;
        $data->save();
        
        return redirect::back();
    }

    public function pengajuan(){
        $pengajuanpdf = pengajuan::where('id_pdf','!=','')->get();
        $pengajuanpkp = pengajuan::where('id_pkp','!=','')->get();
        $pengajuanpromo = pengajuan::where('id_promo','!=','')->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('pv.datapengajuan')->with([
            'pengajuanpdf' => $pengajuanpdf,
            'pengajuanpkp' => $pengajuanpkp,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'pengajuanpromo' => $pengajuanpromo
        ]);
    }

    public function kalenderpkp($id_project)
    {
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $events = [];
        $data = pkp_project::where('id_project',$id_project)->get();
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
      return view('pkp.kalenderpkp')->with([
        'pesan' => $pesan,
        'notif' =>$notif,
        'pengajuan' => $pengajuan,
        'hitungnotif' => $hitungnotif,
        'calendar' => $calendar
    ]);
    }

    public function allcalenderpkp()
    {
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $events = [];
        $data = pkp_project::where('status_project','!=','draf')->get();
        if($data->count()){
            foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                [$value->pkp_number ,$value->ket_no],
                true,
                new \DateTime($value->jangka),
                new \DateTime($value->waktu.' +1 day')
            );
          }
       }
      $calendar = Calendar::addEvents($events); 
      return view('pv.allcalender')->with([
        'pesan' => $pesan,
        'notif' =>$notif,
        'pengajuan' => $pengajuan,
        'hitungnotif' => $hitungnotif,
        'calendar' => $calendar
    ]);
    }

    public function allcalenderpdf()
    {
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $events = [];
        $data = project_pdf::where('status_project','!=','draf')->get();
        if($data->count()){
            foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                [$value->pdf_number ,$value->ket_no],
                true,
                new \DateTime($value->jangka),
                new \DateTime($value->waktu.' +1 day')
            );
          }
       }
      $calendar = Calendar::addEvents($events); 
      return view('pv.allcalendarpdf')->with([
        'pesan' => $pesan,
        'notif' =>$notif,
        'pengajuan' => $pengajuan,
        'hitungnotif' => $hitungnotif,
        'calendar' => $calendar
    ]);
    }

    public function allcalenderpromo()
    {
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        $events = [];
        $data = promo::where('status_project','!=','draf')->get();
        if($data->count()){
            foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                [$value->promo_number ,$value->ket_no],
                true,
                new \DateTime($value->jangka),
                new \DateTime($value->waktu.' +1 day')
            );
          }
       }
      $calendar = Calendar::addEvents($events); 
      return view('pv.allcalendarpromo')->with([
        'pesan' => $pesan,
        'notif' =>$notif,
        'pengajuan' => $pengajuan,
        'hitungnotif' => $hitungnotif,
        'calendar' => $calendar
    ]);
    }

    public function story(){
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('pkp.story')->with([
        'pesan' => $pesan,
        'notif' =>$notif,
        'pengajuan' => $pengajuan,
        'hitungnotif' => $hitungnotif,
        ]);
    }

}