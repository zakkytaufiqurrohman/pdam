<?php
namespace App;
use Illuminate\Foundation\Auth\guard_petugas as Authenticatable;

class guard_petugas extends Authenticatable
{
    protected $table='petugas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey='id_petugas';
    protected $fillable = [
        'username', 'password','token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
