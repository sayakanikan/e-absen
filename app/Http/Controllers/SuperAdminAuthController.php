<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Handlers\EmailSenderHandler;
use App\Handlers\FileUploadHandler;
use App\Handlers\JsonResponseCode;
use App\Handlers\JsonResponseHandler;
use App\Models\SuperAdmin;
use App\Modules\settings\permissionsmatrix\Models\PermissionsmatrixModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class SuperAdminAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $maxAttempts = 3;
    protected $decayMinutes = 2;

    // protected $pengusul;

    // public function __construct(PengusulModel $pengusul)
    // {
    //     $this->pengusul = $pengusul;
    // }

    public function __construct()
    {
        $this->middleware('guest:superadmin')->except('postLogout');
    }

    public function getLogin()
    {
        return view('auth.superadmin.salogin',[
            'title' => "Login",
        ]);
    }

    public function postLogin(Request $request)
    {
        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required|min:5'
        // ]);
        $credentials = $request->validate([
            'email'     => 'required|email:dns',
            'password'  => 'required|min:5'
        ]);

        // if (auth()->guard('admin')->attempt($request->only('email', 'password'))) {
        //     $request->session()->regenerate();
        //     $this->clearLoginAttempts($request);
        //     return redirect()->intended();
        if(auth()->guard('superadmin')->attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        } else {
            // $this->incrementLoginAttempts($request);

            // return redirect()
            //     ->back()
            //     ->withInput()
            //     ->withErrors(["Incorrect user login details!"]);
            return back()->with('loginError', 'Username / Password anda salah!');
        }
    }

    // public function postLogin(Request $request)
    // {
    //     $username = $request->input('username');
    //     $password = $request->input('password');
    //     $user = AdminLogin::where(function ($query) use ($username) {
    //         $query->Where('email', $username);
    //     })->first();
    //     dd(auth());
    //     if ($user == null) {
    //         Session::flush();
    //         Session::put('msgerr', 'User tidak ditemukan');
    //         return Redirect::to('/pengusul/login');
    //     }
    //     $pass_check = Hash::check($password, $user->password);
    //     if (!$pass_check) {
    //         Session::flush();
    //         Session::put('msgerr', 'Password Salah');
    //         return Redirect::to('/pengusul/login');
    //     }
    //     Auth::guard('web_pengusul')->login($user);
    //     Session::put('role_id', 7);
    //     Session::put('role', 'Pengusul');
    //     Session::put('user_id', Auth::guard('web_pengusul')->user()->id);
    //     Session::put('user_name', Auth::guard('web_pengusul')->user()->email);
    //     Session::put('name', Auth::guard('web_pengusul')->user()->nama);
    //     $rolesModel = RolesModel::find(7);
    //     $pms = PermissionsmatrixModel::with(array('permissions' => function ($q) {
    //         $q->where('name', '=', 'site-login');
    //     }))->where('role_id', Session::get('role_id'))->get();
    //     if ($pms->count() > 0) {
    //         return Redirect::to('/' . $rolesModel->login_destination);
    //     } else {
    //         Auth::guard('web_pengusul')->logout();
    //         Session::flush();
    //         Session::put('msgerr', 'You don\'t have permission to sign in into this applications.');
    //         return Redirect::to('/');
    //     }
    // }


    public function postLogout()
    {
        auth()->guard('superadmin')->logout();
        session()->flush();

        return redirect()->route('/');
    }
}
