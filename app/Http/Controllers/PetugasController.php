<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\petugas;
class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $petugas=petugas::all();
        return view('admin.petugas.index',compact('petugas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.petugas.add_petugas');
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
            'username'=>'required|unique:petugas',
            'password'=>'required|min:6|confirmed',
        ]);
       $request['password']=bcrypt($request->input('password'));
       $request['api_token']=bcrypt($request->input('username'));
       petugas::create($request->all());
       return redirect()->route('petugas.index')->with('succes','data berhasil di tambahkan');
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
        $data=petugas::findOrFail($id);
        return view('admin.petugas.edit_petugas',compact('data'));
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
        $this->validate($request,[
            'nama'=>'required|string',
            'username'=>'required|unique:petugas,username,'.$id.',id_petugas',
            'password'=>'|min:6|confirmed',
        ]);
        $petugas=petugas::findOrFail($id);
        $request['password']=$request->get('password') ? bcrypt($request->get('password')) : $petugas->password;
        $petugas->update($request->all());
        return redirect()->route('petugas.index')->with('succes','data berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data=petugas::findOrFail($id);
        $data->delete();
        return redirect()->route('petugas.index')->with('succes','data berhasil di delete');
    }
    public function login(){

        if(auth::guard('guard_petugas')->attempt(['username'=>request('username'),'password'=>request('password')])){
            $data=auth::guard('guard_petugas')->user();
            return response()->json(['success' => $data], 200);
        }
        else{
            return response()->json(['error'=>'email atu password salah'], 401);
        }
    }
}
