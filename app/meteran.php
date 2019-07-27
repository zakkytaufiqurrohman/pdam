<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meteran extends Model
{
    protected $table='meterans';
    protected $fillable=['id_pelanggan','id_petugas','jumlah_meteran','date','harga'];

   public function pelanggan(){

        return $this->belongsTo('App\pelanggan','id_pelanggan');
   }
   public function petugas(){
       return $this->belongsTo('App\petugas','id_petugas');
   }

}
