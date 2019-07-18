<?php

namespace App\Http\Controllers;
use App\pelanggan;
use App\meteran;
use DB;
use Illuminate\Http\Request;

class MeteranController extends Controller
{
    //

    public function index(){
        return view('meteran');
    }
    public function search(Request $request){
        $key=$request->input('key');

        $pelanggan=DB::table('meterans')
        ->join('pelanggans','pelanggans.id_pelanggan','=','meterans.id_pelanggan')
        ->select('meterans.jumlah_meteran','meterans.id','pelanggans.nama')->where('meterans.id',$key)->get();
        
        $cek=count($pelanggan);
        if($cek == 0) {
            $message= 'data tidak ditemukan';
            $response=[
                'message'=>$message,
            ];
            return response()->json($response,404);
        }
        else {
            $message= 'data ditemukan';
            $response=[
            
                'data'=>$pelanggan,
                'message'=>$message,
            ];
            return response()->json($response,200);
        }

        
        
        
    }
}
