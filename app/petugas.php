<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

//Trait for sending notifications in laravel

use Illuminate\Notifications\Notifiable;
//Notification for Seller
use App\Notifications\PetugasResetPasswordNotification;
class petugas extends Authenticatable
{
    //
    use Notifiable;
    protected $table = 'petugas';
    protected $fillable=['id_petugas','nama','username','email','password','api_token'];
    protected $primaryKey = 'id_petugas';

    public function pelanggan(){
        return $this->hasMany('App\pelanggan');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PetugasResetPasswordNotification($token));
    }
    protected $hidden = [
        'password', 'remember_token',
    ];
}
