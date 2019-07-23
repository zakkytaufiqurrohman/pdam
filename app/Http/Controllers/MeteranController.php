<?php

namespace App\Http\Controllers;
use App\pelanggan;
use App\meteran;
use Carbon\Carbon;
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
        ->select('meterans.jumlah_meteran','meterans.id_pelanggan','pelanggans.nama')->where('meterans.id_pelanggan',$key)->orderBy('id','DESC')->first();
        if($pelanggan == NULL) {
            $message= 'data tidak ditemukan';
            $response=[
                'message'=>$message,
            ];
            return response()->json($response,404);
            // return view('add_meteran',compact('response'));
        }
        else {
            $message= 'data ditemukan';
            $response=[
                'data'=>$pelanggan,
                'message'=>$message,
            ];
             return response()->json($response,200);
            // return view('add_meteran',compact('response'));
        }
    }

    public function created(Request $request){
        $this->validate($request,[
            'jumlah_meteran'=>'required',
            'id_pelanggan'=>'required',
            'harga'=>'required',
            'id_petugas'=>'required',//di buat berdasarkan login app petugas

        ]);
        $request['date']= date('Y-m-d');
        meteran::create($request->all());
        $response=[
            'message'=>'data berhasil ditambahkan',
            'status'=>'200',
        ];
        return response()->json($response,200);
    }

}
