<?php

namespace App\Http\Controllers\PetugasAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasswordSuccesController extends Controller
{
    public function index(){
        return view('admin.petugas.password.password_succes');
    }
}
