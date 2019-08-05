<?php

namespace App\Http\Controllers\PetugasAuth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
class ForgotPasswordController extends Controller
{
    //
    use SendsPasswordResetEmails;
    public function showLinkRequestForm()
    {
        return view('admin.petugas.password.email');
    }
    // for api
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {

        return Response()->json(['error'=>'email not found'], 401);

    }
    // for api
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return Response()->json(['succes'=>'email sudah dikirim'], 200);
    }
    // buat broker di config/aut
    public function broker()
    {
         return Password::broker('petugas');
    }
    //kemudian tambahkan tabel reset password
    // buat notification: php artisan make:notification SellerResetPasswordNotification dan tambahkan metode di model sendPasswordResetNotification
}

