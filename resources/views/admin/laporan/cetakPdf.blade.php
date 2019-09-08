<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    @php
        session_start();
        session_destroy();
        session_unset();
    @endphp
	<div class="container">
        <center><h1>Laporan pelanggan </h1></center>
		<br/>
		{{-- <a href="/pegawai/cetak_pdf" class="btn btn-primary" target="_blank">CETAK PDF</a> --}}
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Pelanggan</th>
					<th>Petugas</th>
					<th>jumlah meteran</th>
					<th>Date</th>
					<th>Harga</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($meteran as $p)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$p->pelanggan->nama}}</td>
					<td>{{$p->petugas->nama}}</td>
					<td>{{$p->jumlah_meteran}}</td>
					<td>{{$p->date}}</td>
					<td>{{$p->harga}}</td>

				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>
