<?php

namespace App\Http\Controllers;

use App\Mail\kirimemail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;


use App\pkp\pkp_type;
use App\pkp\pkp_project;
use App\pkp\project_pdf;
use App\pkp\uom;
use App\pkp\data_uom;
use App\pkp\data_ses;
use Carbon\Carbon;
use App\pkp\ses;
use App\pkp\pkp_estimasi_market;
use App\nutfact\mikroba;
use App\master\Tarkon;
use App\pkp\promo;
use App\kemas\datakemas;
use App\pkp\product_allocation;
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

class Email extends Controller
{
    public function sendEmail(Request $request,$id)
    {
        $active = user::where('id',$id)->first();
        $active->status=$request->status;
        $active->save();
        try{
            Mail::send('email', ['nama'=>$request->nama,'role'=>$request->role,'pesan'=>$request->pesan,'email'=>$request->email,'username'=>$request->username,'dept'=>$request->dept,],function($message)use($request)
            {
                $message->subject($request->judul);
                // $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                $message->to($request->email);
            });
            return back()->with('status','Berhasil Kirim Email');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function emailpdf(Request $request,$id_project_pdf,$revisi, $turunan){
        $datapdf = coba::where('pdf_id',$id_project_pdf)->count();
        $pdf1 = coba::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pdf = project_pdf::join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where('id_project_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $for = data_forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $ses = data_ses::where([ ['id_pdf',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $picture = picture::where('pdf_id',$id_project_pdf)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        try{
            Mail::send('pv.emailpdf', [
                'pdf' => $pdf,
                'pdf1' => $pdf1,
                'datases' => $ses,
                'for' => $for,
                'datapdf' => $datapdf,
                'picture' => $picture,], function ($message) use ($request)
                {
                    $message->subject($request->judul);
                    $message->from('app.prodev@nutrifood.co.id', 'User PV');
                    $message->to($request->email);
                    $message->cc($request->pengirim);
                });
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function emailpromo(Request $request,$id_pkp_promo,$revisi, $turunan){
        $promoo = data_promo::join('pkp_promo','isi_promo.id_pkp_promoo','=','pkp_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $promo1 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $app = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $jumlahpromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $allocation = product_allocation::where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $picture = picture::where('promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        try{
            Mail::send('pv.emailpromo', [
                'promo' => $promo,
                'promo1' => $promo1,
                'promoo' => $promoo,
                'app' => $app,
                'picture' => $picture,
                'allocation' => $allocation,
                'jumlahpromo' => $jumlahpromo,], function ($message) use ($request)
            {
                $message->subject($request->judul);
                $message->from('app.prodev@nutrifood.co.id', 'User PV');
                $message->to($request->email);
                $message->cc($request->pengirim);
            });
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function emailpkp(Request $request,$id_project,$revisi, $turunan){
        $datapkp = tipp::where('id_pkp',$id_project)->count();
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $for = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $dataklaim = data_klaim::where('id_pkp',$id_project)->join('klaim','klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pkpp = tipp::join('pkp_project','tippu.id_pkp','=','pkp_project.id_project')->where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $ses= data_ses::where([ ['id_pkp',$id_project], ['revisi','<=',$revisi], ['turunan','<=',$turunan] ])->orderBy('revisi','desc')->orderBy('turunan','desc')->get();
        $uom= data_uom::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $pkp1 = tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $datadetail = data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $picture = picture::where('pkp_id',$id_project)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        try{
            Mail::send('pv.emailpkp', [
            'pkpp' => $pkpp,
            'pkp' => $pkp,
            'datases' => $ses,
            'datauom' => $uom,
            'for' => $for,
            'datadetail' => $datadetail,
            'dataklaim' => $dataklaim,
            'pkp1' => $pkp1,
            'datapkp' => $datapkp,
            'picture' => $picture,], function ($message) use ($request)
            {
                $message->subject($request->judul);
                $message->from('app.prodev@nutrifood.co.id', 'User PV');
                $message->to($request->email);
                $message->cc($request->pengirim);
            });
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }
}
