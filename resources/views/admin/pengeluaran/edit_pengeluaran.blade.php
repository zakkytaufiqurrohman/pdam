@extends('layouts.admin.app')

@section('body')
<section class="content-wrapper">
        {{-- <section class="content-header">
            <h3>add data</h3>
        </section> --}}
        <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">insert Pengeluaran</h3>
                </div>
                <div class="box-body">
                    <form action="{{route('pengeluaran.update',$data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label>nama pengeluaran:</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required value="{{$data->nama_pengeluaran}}" autofocus ">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                                <label>price:</label>
                                <input type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" required value="{{$data->jumlah}} ">
                                @error('jumlah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <img width="80px" src="{{asset('img/'.$data->img)}}" alt="" style="padding:10px">
                            <input type="file" class="form-control @error('img') is-invalid @enderror" name="img" placeholder="img" autofocus ">
                            @error('img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            {{-- <input type="file" name="img"> --}}
                        </div>
                        <button class="btn btn-primary">kirim</button>
                    </form>
                </div>
</section>
@endsection
