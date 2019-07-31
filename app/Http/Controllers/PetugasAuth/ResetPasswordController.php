<?php

namespace App\Http\Controllers\PetugasAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
class ResetPasswordController extends Controller
{
    //
    protected $redirectTo = '/password_succes';
    use ResetsPasswords;
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.petugas.password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    public function broker()
    {
        return Password::broker('petugas');
    }


    //returns authentication guard of seller
    protected function guard()
    {
        return Auth::guard('petugas');
    }
}
