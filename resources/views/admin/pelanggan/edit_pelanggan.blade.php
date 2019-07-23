@extends('layouts.admin.app')

@section('body')
<section class="content-wrapper">
        {{-- <section class="content-header">
            <h3>add data</h3>
        </section> --}}
        <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">insert pelanggan</h3>
                </div>
                <div class="box-body">
                    <form action="{{route('pelanggan.update',$data->id_pelanggan)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label>nama pelanggan:</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required value="{{$data->nama}}" autofocus ">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                                <label>Alamat:</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" required value="{{$data->alamat}} ">
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                                <label>petugas:</label>
                                @php
                                    $select=$data->id_petugas;
                                @endphp
                                <select name="id_petugas" id="" class="form-control" @error('petugas') is-invalid @enderror" required>
                                    <option value=""> pilih nama petugas</option>
                                    @foreach ($petugas as $data)
                                        <option value="{{$data->id_petugas}}" {{$select == $data->id_petugas ? 'selected="selected"': ''}}>{{$data->nama}}</option>
                                    @endforeach
                                </select>
                                @error('petugas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <button class="btn-succes btn">kirim</button>
                    </form>
                </div>
</section>
@endsection
