@extends('layouts.admin.app')
@section('body')
<section class="content-wrapper">
    <div class="col-xs-12">
        <div class="mt-xl-10">
            <p></p>
        </div>
        <div class="box mt-100 " >
                @if ($succes = Session::get('succes'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $succes }}</strong>
                </div>
                @endif
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <form action="{{route('ganti.action')}}"  method="post">
                        @csrf
                        <div class="form-group">
                            <label>password lama:</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required placeholder="password lama" autofocus ">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @csrf
                        <div class="form-group">
                            <label>new password:</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required placeholder="new_password" autofocus ">
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @csrf
                        <div class="form-group">
                            <label>confirm password:</label>
                            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required placeholder="confirm_password" autofocus ">
                            @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit">kirim</button>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
         <!-- /.box -->

    </div>
</div>
</section>
@endsection
