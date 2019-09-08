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
                    @if ($succes = Session::get('succes'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $succes }}</strong>
                    </div>
                    @endif
                    <div class="box-header">
                        <a href="{{route('pengeluaran.create')}}" class="box-title btn-success btn-sm">Add data</a>
                    <h3>total pengeluaran {{$total}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                        <th>No</th>
                        <th>nama pengeluran</th>
                        <th>price</th>
                        <th>foto</th>
                        <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($datas as $data)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data->nama_pengeluaran}}</td>
                                <td>{{$data->jumlah}}</td>
                            <td><img width="50px" src="{{ asset('img/'.$data->img)}}" alt=""> </td>
                                <td>
                                    <form action="{{route('pengeluaran.destroy',$data->id)}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">

                                        <a href="{{route('pengeluaran.edit',$data->id)}}" class="btn-primary btn-sm">edit</a>
                                        <button type="submit" class="btn-primary btn-sm">delete</button>
                                    </form>
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
@section('asset-button')

    <script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
        $(function () {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })
        })
      </script>
@endsection
