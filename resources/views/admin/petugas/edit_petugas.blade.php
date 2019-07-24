@extends('layouts.admin.app')

@section('body')
<section class="content-wrapper">
        {{-- <section class="content-header">
            <h3>add data</h3>
        </section> --}}
        <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">edit petugas</h3>
                </div>
                <div class="box-body">
                    <form action="{{route('petugas.update',$data->id_petugas)}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label>nama petugas:</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required value="{{$data->nama}}" autofocus ">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>username:</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" required value="{{$data->username}}" autofocus ">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>password:</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{$data->password}}" placeholder="password" autofocus ">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>re-password:</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" value="{{$data->password}}" placeholder="password" autofocus ">
                            @error('password')
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
