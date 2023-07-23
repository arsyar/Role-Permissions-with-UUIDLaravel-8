<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    function submitForgetPassword(Request $request) : Returntype {
        $this->validate([
            'email' => 'required|email|exists:users'
        ]);
        $token = Str::random(55);

        try {
            DB::beginTransaction();
            DB::table('password_resets')->insert([
                'email' => $request->emails,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            Maill::send('email.forgetPassword',['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });
            DB::commit();
            return redirect()->back()->with('Kami telah mengirim link reset di Email');
        } catch (Exception $e) {
            return redirect()->back()->with('Reset gagal diproses');
        }
    }
    function showResetPasswrdFrom($token) : Returntype {
        return view('reset_pasword.resetPasswordLink', ['token' => $token]);
    }

    function submitResetPaswwordFrom(Request $request) : Returntype {
        $request->validate([
            'email' => 'email|required|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password' => 'required'
        ]);

        // cek token di table reset password

        $updatePassword = DB::table('password_reset')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if (!$updatePassword) {
            return redirect()->back()->withInput()->with('error', 'Token tidak ditemukan');
        }
        // ubah password
        try {
            DB::beginTransaction();
            $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
            DB::table('password_resets')->where(['email' => $request->email])->delete();
            DB::commit();
            return redirect('/login')->with('message','Password berhasil diubah!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message','Ubah password gagal');
        }
    }
}
