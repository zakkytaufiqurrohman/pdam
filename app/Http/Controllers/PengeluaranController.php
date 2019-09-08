<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pengeluaran;
class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas=pengeluaran::all();
        $total=pengeluaran::with('sort')->sum('jumlah');
        return view('admin.pengeluaran.index',compact('datas','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pengeluaran.add_pengeluaran');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
			'img' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string',
            'jumlah'=> 'required|int'
		]);

		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('img');

		$nama_file = time()."_".$file->getClientOriginalName();

      	        // isi dengan nama folder tempat kemana file diupload
                  $tujuan_upload = 'img';
                  $file->move($tujuan_upload,$nama_file);

		pengeluaran::create([
			'img' => $nama_file,
            'nama_pengeluaran' => $request->nama,
            'jumlah'=>$request->jumlah
		]);

        return redirect()->route('pengeluaran.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data=pengeluaran::findOrFail($id);
        return view('admin.pengeluaran.edit_pengeluaran',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'img' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'string',
            'jumlah'=> 'int'
        ]);
        $data=pengeluaran::findOrFail($id);
        if($file=$request->file('img')){

            // delete file lama in storag
            $image_path = public_path().'/img/'.$data->img;
            unlink($image_path);

            $file = $request->file('img');
		    $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img';
		    $file->move($tujuan_upload,$nama_file);
            $data->img = $nama_file;
        }
        else{
            $data->img=$data->img;

        }
        $data->nama_pengeluaran=$request->nama;
        $data->jumlah=$request->jumlah;
        $data->save();
        return redirect()->route('pengeluaran.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=pengeluaran::findOrFail($id);
        $data->delete();
        $patch=public_path().'/img/'.$data->img;
        unlink($patch);
        return redirect()->route('pengeluaran.index');
    }
}
