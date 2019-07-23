<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    //
    protected $table = 'pelanggans';
    protected $fillable=['id_pelanggan','id_petugas','nama','alamat','barcode'];
    protected $primaryKey = 'id_pelanggan';
    public function petugas(){
       return $this->belongsTo('App\petugas','id_petugas');
    }
}
