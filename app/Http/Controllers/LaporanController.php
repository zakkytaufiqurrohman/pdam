<?php

namespace App\Http\Controllers;
use App\meteran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Session;
use PDF;
use App\pengeluaran;
class LaporanController extends Controller
{
    public function index(){

         $pelanggan=meteran::groupBy('id_pelanggan')->get();
         $petugas=meteran::groupBy('id_petugas')->get();
         $meteran=meteran::all();
         $costs = meteran::with('Sort')->sum('harga');
         $pengeluaran=pengeluaran::with('sort')->sum('jumlah');
         return view('admin.laporan.index',compact('meteran','pelanggan','petugas','costs','pengeluaran'));
    }
    public function coba(Request $request){
        if($request->ajax()){
            $output="";
            // $meteran="DB::table('meterans')->where('id_petugas','!=',0)";
            //  $meteran=meteran::all();
             $meteran=meteran::where('id_petugas','!=',0);
            if(isset($request->id_pelanggan)){
                // $meteran=meteran::where('id_pelanggan',$request->id_pelanggan)->get();
                // $meteran=DB::table('meterans')->where('id_pelanggan',$request->id_pelanggan)->get();
                // $meteran=$meteran->whereIn('id_pelanggan',$request->id_pelanggan);
                $meteran->where('id_pelanggan','=',$request->id_pelanggan);
            }
            else if(isset($request->id_petugas)){
                // $meteran=meteran::where('id_petugas',$request->id_petugas)->get();
                // if(isset($request->tahun)){
                //     $meteran=meteran::where('id_petugas',$request->id_petugas)->
                //     whereYear('date',$request->tahun)->get();
                // }
                // $meteran=$meteran->whereIn('id_petugas',$request->id_petugas);
                $meteran->where('id_petugas',$request->id_petugas);
            }
            else if(isset($request->tahun)){
                // $meteran=meteran::whereYear('date',$request->tahun)->get();
                // $meteran=$meteran->whereYear('date',$request->tahun);
                $meteran->whereYear('date',$request->tahun);
            }

            // $meteran=meteran::where(function($query){
            //     global $request;
            //     if(isset($_POST['id_pelanggan'])){
            //             // $meteran=meteran::where('id_pelanggan',$request->id_pelanggan)->get();
            //             // $meteran=DB::table('meterans')->where('id_pelanggan',$request->id_pelanggan)->get();
            //           $query->where('id_pelanggan',$_POST['id_pelanggan']);
            //             // return $request->id_pelanggan;
            //         }
            //         else if(isset($_POST['id_petugas'])){
            //             // $meteran=meteran::where('id_petugas',$request->id_petugas)->get();
            //             $query->where('id_petugas',$_POST['id_petugas']);
            //             if(isset($_POST['tahun'])){
            //                 // $meteran=meteran::where('id_petugas',$request->id_petugas)->
            //                $query->whereYear('date',$request->tahun)->get();
            //             }
            //             // $meteran=$meteran->whereIn('id_petugas',$request->id_petugas);
            //         }
            //         else if(isset($_POST['tahun'])){
            //             // $meteran=meteran::whereYear('date',$request->tahun)->get();
            //             // $meteran=$meteran->whereYear('date',$request->tahun);
            //             $query->whereYear('date',$_POST['tahun']);
            //         }
            // })->get();
            // return $meteran;
            $no=1;
            $meteran2=$meteran->get();
            Session::put('key',$meteran2);
            foreach($meteran2 as $data){
                $output .='<tr>'.
                '<td>'.$no++.'</td>'.
                '<td>'.$data->pelanggan->nama.'</td>'.
                '<td>'.$data->petugas->nama.'</td>'.
                '<td>'.$data->jumlah_meteran.'</td>'.
                '<td>'.$data->date.'</td>'.
                '<td>'.$data->harga.'</td>'.
                '</tr>';
            }
            return Response($output);
            // return $meteran2;
        }

    }
    public function cari(Request $request){
        if($request->ajax()){
            $output="";
            if($request->mulai != '' && $request->akhir != '')
            {
                $datas = meteran::whereBetween('date', array($request->get('mulai'), $request->get('akhir')))
                 ->get();
            }
            else
            {
                $datas = DB::table('meterans')->orderBy('date', 'desc')->get();
            }
            // $this->pdf2($datas);
            Session::put('key',$datas);
            $no=1;
            foreach($datas as $data){
                $output .='<tr>'.
                '<td>'.$no++.'</td>'.
                '<td>'.$data->pelanggan->nama.'</td>'.
                '<td>'.$data->petugas->nama.'</td>'.
                '<td>'.$data->jumlah_meteran.'</td>'.
                '<td>'.$data->date.'</td>'.
                '<td>'.$data->harga.'</td>'.
                '</tr>';
            }
            return Response($output);
        }
    }
    public function pdf2($data){
       return $data;
    }
    public function cetakPdf(){
        $time = $_SERVER['REQUEST_TIME'];
        $timeout_duration = 5;
        if (isset($_SESSION['LAST_ACTIVITY']) &&
        ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
            session_unset();
            session_destroy();
            session_start();
        }
        $_SESSION['LAST_ACTIVITY'] = $time;

        $data=Session::get('key');
        if(!isset($data)){
            $data=meteran::all();
            $pdf = PDF::loadview('admin.laporan.cetakPdf',['meteran'=>$data]);
        }
        $data=Session::get('key');
        $pdf = PDF::loadview('admin.laporan.cetakPdf',['meteran'=>$data]);
        Session_start();
        Session_destroy();
        return $pdf->download('laporan-meteran-pdf');

    }

}
