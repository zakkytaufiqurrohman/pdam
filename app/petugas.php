<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class petugas extends Model
{
    //
    protected $table = 'petugas';
    protected $fillable=['id_petugas','nama','username','password','api_token'];
    protected $primaryKey = 'id_petugas';
    public function pelanggan(){
        return $this->hasMany('App\pelanggan');
    }
}
