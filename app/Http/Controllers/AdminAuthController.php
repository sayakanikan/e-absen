<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Handlers\EmailSenderHandler;
use App\Handlers\FileUploadHandler;
use App\Handlers\JsonResponseCode;
use App\Handlers\JsonResponseHandler;
use App\Modules\masterdata\kep\Models\ActivationLinkModel;
use App\Models\AdminLogin;
use App\Modules\masterdata\pengusul\Request\PengusulRegisterRequest;
use App\Modules\settings\permissionsmatrix\Models\PermissionsmatrixModel;
use App\Modules\settings\roles\Models\RolesModel;
use Gemboot\Controllers\CoreRestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;


class AdminAuthController extends Controller
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
        $this->middleware('guest:admin')->except('postLogout');
    }

    public function getLogin()
    {
        return view('auth.admin.alogin',[
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
        if(auth()->guard('admin')->attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/dashboardAdmin');
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
        auth()->guard('admin')->logout();
        session()->flush();

        return redirect()->route('admin.login');
    }

    // public function getForgotPassword()
    // {
    //     $title = "digiTEPP | Lupa Password Pengusul";
    //     return View::make('pengusul::forgot_password', compact('title'));
    // }

    // public function postForgotPassword(Request $request)
    // {
    //     $email = $request->input('email');
    //     $pengusul = PengusulModel::where('email', $email)->first();
    //     if ($pengusul == null) {
    //         return JsonResponseHandler::setCode(JsonResponseCode::NOT_FOUND)
    //             ->setMessage('Data pengusul dengan email tersebut tidak ditemukan')
    //             ->setStatus(404)
    //             ->send();
    //     }
    //     $temporary_password = Str::random(6);
    //     PengusulModel::where('email', $email)->update(['password' => Hash::make($temporary_password)]);
    //     EmailSenderHandler::sender("pengusul::reset_password_email", ['new_password' => $temporary_password,  'name' => $pengusul->nama, 'email' => $email], "digiTepp | Reset Password");
    //     return JsonResponseHandler::setResult([])->setMessage("Password sementara sudah dikirim melalui email")->send();
    // }

    // public function getActivation(Request $req)
    // {
    //     $request = $req->all();
    //     if (isset($request["token"])) {
    //         $checklink = ActivationLinkModel::where('token', $request["token"])->first();
    //         if ($checklink) {
    //             PengusulModel::where('email', $checklink->email)->update(['status' => 'A']);
    //             $html = '
    //             <h4 class="text-center text-green"><b>Aktivasi Berhasil</b></h4>
    //             <p class="text-center">
    //                 Aktivasi akun <b>PENGUSUL</b> berhasil, silahkan tunggu beberapa detik.
    //             </p>
    //             ';
    //         } else {
    //             $html = '
    //             <h4 class="text-center text-danger"><b>Email/Token tidak terdaftar dalam database</b></h4>
    //             ';
    //         }
    //     } else {
    //         $html = '
    //         <h4 class="text-center text-danger"><b>Link tidak ditemukan / salah</b></h4>
    //         ';
    //     }
    //     $data = array(
    //         'html'
    //     );
    //     // dd($html);
    //     return View::make('pengusul::activation', compact($data));
    // }

}
