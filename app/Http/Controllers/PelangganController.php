<?php

namespace App\Http\Controllers;
use App\pelanggan;
use App\petugas;
use Illuminate\Http\Request;
use App\meteran;
use Carbon\Carbon;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan=pelanggan::all();
        return view('admin.pelanggan.index',compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $petugas=petugas::all();
        return view('admin.pelanggan.add_pelanggan',compact('petugas'));
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
        $this->validate($request,[
            'nama'=>'required|string',
            'id_petugas'=>'int|required',
            'alamat'=>'required',
        ]);
        $data=pelanggan::create([
            'id_petugas'=>$request->input('id_petugas'),
            'nama'=>$request->input('nama'),
            'alamat'=>$request->input('alamat'),
            'barcode'=>'1',
        ]);

        $datas=pelanggan::orderBy('id_pelanggan','DESC')->first();
        $data->barcode="http://localhost:8000/seach/".$datas->id_pelanggan;
        $data->save();
        // insert ke db meteran
        $meteran=new meteran;
        $meteran->id_pelanggan=$datas->id_pelanggan;
        $meteran->id_petugas=$request->input('id_petugas');
        $meteran->jumlah_meteran=0;
        $meteran->date=date('Y-m-d');
        $meteran->harga=0;
        $meteran->save();

        return redirect()->route('pelanggan.index')->with('succes','data berhasil di tambahkan');
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
         $pelanggan=pelanggan::findOrFail($id);
         return view('admin.pelanggan.show_pelanggan',compact('pelanggan'));

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
        $petugas=petugas::all();
        $data=pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit_pelanggan',compact('data','petugas'));
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
        //
        $data=pelanggan::findOrFail($id);
        $this->validate($request,[
            'nama'=>'required',
            'alamat'=>'required',
            'id_petugas'=>'required',
        ]);
        // return $request->all();
        $data->update($request->all());
        return redirect()->route('pelanggan.index')->with('succes','data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=pelanggan::findOrFail($id);
        $data->delete();
        return redirect()->route('pelanggan.index')->with('succes','data berhasil di delete');
    }

}
