@extends('layouts.admin.app')
@section('asset-top')
    <!-- DataTables -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">


  {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>
<script src="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap.min.css"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script> --}}
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
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <select name="pelanggan" class="pelanggan">
                        <option value="">pilih pelanggan</option>
                        @foreach ($pelanggan as $item)
                            <option value="{{$item->id_pelanggan}}">{{$item->pelanggan->nama}}</option>
                        @endforeach
                    </select>
                    <select name="petugas" class="petugas">
                            <option value="">pilih petugas</option>
                            @foreach ($petugas as $item)
                                <option value="{{$item->id_petugas}}">{{$item->petugas->nama}}</option>
                            @endforeach
                        </select>
                    <select name="tahun" class="tahun">
                                <option value="">pilih tahun</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                {{-- @foreach ($petugas as $item)
                                    <option value="{{$item->id_petugas}}">{{$item->petugas->nama}}</option>
                                @endforeach --}}
                    </select>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                        <th>No</th>
                        <th>nama pelanggan</th>
                        <th>nama petugas</th>
                        <th>jumlah meteran</th>
                        <th>tanggal</th>
                        <th>harga</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($meteran as $data)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data->pelanggan->nama}}</td>
                                <td>{{$data->petugas->nama}}</td>
                                <td>{{$data->jumlah_meteran}}</td>
                                <td>{{$data->date}}</td>
                                <td>{{$data->harga}}</td>
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

    <script>
            $(function () {
                $('#example1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            } );
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                buttons: [
                 'print'
        ]
            })
            })
    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })

        $(".pelanggan").change(function(){
            var pelanggan= $('.pelanggan').val();
            var petugas= $('.petugas').val();
            $.ajax({
                type:"post",
                url:'{{ route('laporan.coba')}}',
                data:{ id_pelanggan: pelanggan },
                success:function(data){
                    $('tbody').html(data);
                    // console.log(data);
                }

            })
        })
        $(".petugas").change(function(){
            var petugas= $('.petugas').val();
            $.ajax({
                type:"post",
                url:'{{ route('laporan.coba')}}',
                data:{ id_petugas: petugas },
                success:function(data){
                    $('tbody').html(data);
                }

            })
        })
        $(".tahun").change(function(){
            var tahun= $('.tahun').val();
            $.ajax({
                type:"post",
                url:'{{ route('laporan.coba')}}',
                data:{ tahun: tahun },
                success:function(data){
                    $('tbody').html(data);
                }

            })
        })
    </script>
@endsection
