<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meteran extends Model
{
    protected $fillable=['id_pelanggan','id_petugas','jumlah_meteran','date','hargae'];
}
