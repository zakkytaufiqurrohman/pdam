<html>

<head>
</head>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<body>
    @php
        $jumlah_meteran=$response['data']->jumlah_meteran;
        $nama=$response['data']->nama;
        $id_pelanggan=$response['data']->id_pelanggan;
    @endphp
    <form action={{ route('save')}} method="POST">
        @csrf
        <input type="text" name='id_pelanggan' value="{{$id_pelanggan}} " readonly ><br>
        <input type="text" name="nama" value="{{$nama}} " ><br>
        <input type="text" name="jumlah_meteran_lama" value="{{$jumlah_meteran}}" readOnly><br>
        masukkan jumlah meteran sekarang
         <input type="text" name='jumlah_meteran' id="jumlah_meteran"><br>
         total bayar
         <input type="text" name='harga' class="total" value=0><br>

        <button name=submit>kirim</button>
    </form>

</body>
<script>
    $("#jumlah_meteran").keyup(function(){
        var lama="<?php echo $jumlah_meteran?>";
        var x=$(this).val();
        harga=( x-parseFloat(lama)) * 1500;
        $(".total").val(harga);
        console.log(lama);

    });

</script>


</html>
