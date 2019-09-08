@extends('layouts.admin.app')

@section('body')
<section class="content-wrapper">
        {{-- <section class="content-header">
            <h3>add data</h3>
        </section> --}}
        <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">insert pengeluaran</h3>
                </div>
                <div class="box-body">
                    <form action="{{route('pengeluaran.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>nama pengeluaran:</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required placeholder="nama" autofocus ">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                                <label>price:</label>
                                <input type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" required placeholder="jumlah" autofocus ">
                                @error('jumlah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label>silahkan upload file nota:</label>
                            <input type="file" class="form-control @error('img') is-invalid @enderror" name="img" required placeholder="img" autofocus ">
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
