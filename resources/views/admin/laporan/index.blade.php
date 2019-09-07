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
                        <div class="container">
                            <div class="row">
                                    <div class="col-md-4 ">
                                            <form class="input-daterange" id="data" >

                                                <div class="input-group input-daterange">
                                                <div class="form-group">
                                                    <label>masukkan awal tgl/bulan</label>
                                                    <input type="text" name="mulai" id="mulai" readonly class="form-control @error('mulai') is-invalid @enderror" name="mulai" required  ">
                                                    @error('mulai')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                                </div>
                                                {{-- <div class="input-group-addon">to</div> --}}
                                                <div class="form-group">
                                                    <label>sampai tgl</label>
                                                    <input type="text" name="akhir" id="akhir" readonly class="form-control @error('akhir') is-invalid @enderror" name="akhir" required  autofocus ">
                                                    @error('akhir')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                        {{-- <input type="text" id="mulai" readonly class="form-control" />
                                                        <div class="input-group-addon">to</div>
                                                        <input type="text" id="akhir" readonly class="form-control" /> --}}
                                                <button class="btn btn-primary cari" style="margin:20px 0 20px 0">cari</button>
                                                <br>
                                                </form>
                                                </div>
                                              </div>
                            </div>

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
                        </div>
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

    {{-- <script>
            // $(function () {
            //     $('#example1').DataTable( {
            //     dom: 'Bfrtip',
            //     buttons: [
            //         'print'
            //     ]
            // } );
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
            // })
    </script> --}}
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
                    // console.log(data);
                }
            })
        })
    </script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script>

        $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: 'yyyy-mm-dd',
        autoclose: true
        });
</script>
   <script>

        $(".cari").click(function(){
            event.preventDefault();
            var mulai=$('#mulai').val();
            var akhir=$('#akhir').val();
            $.ajax({
                type:"post",
                url:'{{route('laporan.cari')}}',
                data:{mulai:mulai,akhir:akhir},

                success:function(data){
                    $('tbody').html(data);

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(xhr.responseText);
                    console.log(thrownError);
                }
            })
        })

    </script>
@endsection
