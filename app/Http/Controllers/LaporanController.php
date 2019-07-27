<?php

namespace App\Http\Controllers;
use App\meteran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class LaporanController extends Controller
{
    public function index(){

         $pelanggan=meteran::groupBy('id_pelanggan')->get();
         $petugas=meteran::groupBy('id_petugas')->get();
         $meteran=meteran::all();
         return view('admin.laporan.index',compact('meteran','pelanggan','petugas'));
    }
    public function coba(Request $request){

        if($request->ajax()){
            $output="";

            if(isset($request->id_pelanggan)){
                $meteran=meteran::where('id_pelanggan',$request->id_pelanggan)->get();
            }
            else if(isset($request->id_petugas)){
                $meteran=meteran::where('id_petugas',$request->id_petugas)->get();
                if(isset($request->tahun)){
                    $meteran=meteran::where('id_petugas',$request->id_petugas)->
                    whereYear('date',$request->tahun)->get();
                }
            }
            else if(isset($request->tahun)){
                $meteran=meteran::whereYear('date',$request->tahun)->get();
            }
            $no=1;
            foreach($meteran as $data){
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
}
