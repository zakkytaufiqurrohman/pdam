@extends('layouts.admin.app')
@section('asset-top')
    <title>Edit Users</title>
@endsection
​
@section('body')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                            @if ($succes = Session::get('succes'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $succes }}</strong>
                                </div>
                            @endif

                            <form action="{{ route('users.update', $user->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="name"
                                        value="{{ $user->name }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email"
                                        value="{{ $user->email }}"
                                        class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}"
                                        required readonly>
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password"
                                        class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                    <p class="text-warning">Biarkan kosong, jika tidak ingin mengganti password</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-send"></i> Update
                                    </button>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
