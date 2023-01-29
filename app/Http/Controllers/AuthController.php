<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{

    public function index(){
        return view('auth/login', [
            'title' => "Login",
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email'     => 'required|email:dns',
            'password'  => 'required|min:5'
        ]);

        // if(Auth::attempt($credentials) ){
        //     $request->session()->regenerate();

        //     return redirect()->intended('/dashboard');
        // }

        if(Auth::guard('web')->attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        } 
        // else if (Auth::guard('admin')->attempt($request->only('email', 'password'))){
        //     $request->session()->regenerate();
        //     dd($request);
        //     return redirect()->intended('/dashboard');
        // } else if (Auth::guard('superAdmin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
        //     $request->session()->regenerate();

        //     return redirect()->intended('/dashboard');
        // }

        return back()->with('loginError', 'Username / Password anda salah!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function forgot(){
        return view('auth/forgotPassword', [
            'title' => 'Reset Password'
        ]);
    }

    public function sendEmail(Request $request){
        $validatedEmail = $request->validate([
            'email' => 'min:5|email:dns'
        ]);
        // $validatedEmail = $validatedEmail['email'];

        $emailExist = User::where('email', $validatedEmail)->first();
        if ($emailExist == null) {
            return redirect('/forgotpassword')->with('loginError', 'Email anda tidak terdaftar pada aplikasi, Silahkan gunakan email lain.');
        }
        $status = Password::sendResetLink(
            $validatedEmail
        );

        return $status === Password::RESET_LINK_SENT
                ? redirect('/login')->with('success', 'Link reset password berhasil dikirim ke email anda. Silahkan cek email anda!')
                : back()->with('loginError', 'Masalah pada jaringan, silahkan coba lagi!');
    }

    public function resetPassword($token){
        return view('auth/resetPassword', [
            'title' => 'Reset Password',
            'token' => $token
        ]);
    }

    public function updatePassword(Request $request){
        $data = $request->validate([
            'token'     => 'required',
            'email'     => 'required|email:dns|min:5',
            'password'  => 'required|min:5',
        ]);

        $emailExist = User::where('email', $data['email'])->first();
        if ($emailExist == null) {
            return back()->with('loginError', 'Email anda tidak terdaftar pada aplikasi, Silahkan gunakan email lain.');
        }

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect('/login')->with('success', 'Password berhasil direset, Silahkan login dengan password baru!')
                    : back()->withErrors(['loginError' => [__($status)]]);
    }
}
