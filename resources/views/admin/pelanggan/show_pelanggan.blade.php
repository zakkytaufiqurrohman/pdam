@extends('layouts.admin.app')
@section('body')
<section class="content-wrapper">
    <div class="col-xs-12">
        <div class="mt-xl-10">
            <p></p>
        </div>
        <div class="box mt-100 " >
                        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($pelanggan->barcode, 'QRCODE',10,10)}}" alt="barcode" />
        </div>
    </div>
</section>
@endsection
@section('asset-button')
<script>
    window.print();
</script>
@endsection
