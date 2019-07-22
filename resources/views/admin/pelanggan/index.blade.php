@extends('layouts.admin.app')
@section('asset-top')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('body')
<section class="content-wrapper">

        <div class="col-xs-12">
            <div class="mt-xl-10">
                <p></p>
            </div>
            <div class="box mt-100 " >
                    <div class="box-header">
                    <a href="{{route('pelanggan.create')}}" class="box-title btn-success btn-sm">Add data</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                        <th>No</th>
                        <th>nama</th>
                        <th>alamat</th>
                        <th>barcode</th>
                        <th>petugas</th>
                        <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($pelanggan as $data)
                            <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->alamat}}</td>
                            <td>{{$data->barcode}}</td>
                            <td>{{$data->petugas->nama}}</td>
                                <td>
                                        <a href="" class="btn-primary btn-sm">show</a>
                                        <a href="" class="btn-primary btn-sm">edit</a>
                                        <button type="button" class="btn-primary btn-sm">delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                    <!-- /.box-body -->
                </div>
             <!-- /.box -->
            </div>
        </div>
    </div>
</section>
@endsection
