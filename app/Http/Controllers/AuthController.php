<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Models\Masyarakat;

class AuthController extends Controller
{
    use ThrottlesLogins;

    protected $maxAttempts = 5;

    protected $decayMinutes = 1;

    public function showFormLogin()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::guard('masyarakat')->check()) {
            return redirect()->route('masyarakat.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'username'                 => 'required|string',
            'password'              => 'required|string'
        ];

        $messages = [
            'username.required'        => 'Username wajib diisi',
            'username.string'          => 'Username harus berupa string',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'username'     => $request->input('username'),
            'password'  => $request->input('password'),
        ];

        // Auth::attempt($data);

        // if (Auth::check()) {
        //     return redirect()->route('admin.dashboard');

        // } else {
        //     $masyarakat = Masyarakat::where('username','=',$data["username"])->where('password','=',Hash::make(""))
        //     Session::flash('error', 'Username atau password salah');
        //     return redirect()->route('login');
        // }


        if(Auth::attempt($data,$request->filled('remember'))){
          return redirect()->route('admin.dashboard');
        } else if (Auth::guard('masyarakat')->attempt($data,$request->filled('remember'))) {
          return redirect()->route('masyarakat.dashboard');
        }else{
            Session::flash('error', 'Username atau password salah');
            return redirect()->route('login');
        }

        // if(auth()->attempt($data))
        // {
        //     if (auth()->user()->check()) {
        //         return redirect()->route('admin.home');
        //     }else{
        //         return redirect()->route('home');
        //     }
        // }else{
        //     return redirect()->route('login')
        //         ->with('error','Email-Address And Password Are Wrong.');
        // }

    }

    public function showFormRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'nik' => 'required|alpha_num|min:16|max:16|unique:masyarakat,nik',
            'nama' => 'required|min:3|max:35',
            'username' => 'required|string|min:5|max:25|unique:masyarakat,username',
            'telp' => 'required|alpha_num|phone:id|min:10|max:13',
            'password'  => 'required|min:8|confirmed'
        ];

        $messages = [
            'nik.required' => 'Nomor Induk Kependudukan wajib diisi',
            'nik.min' => 'Nomor Induk Kependudukan minimal 16 nomor',
            'nik.max' => 'Nomor Induk Kependudukan maximal 16 nomor',
            'nik.unique' => 'Nomor Induk Kependudukan sudah terdaftar',
            'nama.required' => 'Nama lengkap wajib diisi',
            'nama.min' => 'Nama lengkap minimal 3 karakter',
            'nama.max' => 'Nama lengkap maksimal 35 karakter',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah terdaftar',
            'telp.required' => 'Nomor telepon wajib diisi',
            'telp.min' => 'Nomor telepon minimal 10 nomor',
            'telp.max' => 'Nomor telepon maximal 13 nomor',
            'telp.phone' => 'Nomor telepon tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama dengan konfirmasi password'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = new Masyarakat;
        $user->nik = $request->nik;
        $user->nama = ucwords(strtolower($request->nama));
        $user->telp = $request->telp;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $simpan = $user->save();

        if($simpan){
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect()->route('login');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('register');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('login')->withSuccess('Anda berhasil logout!');
    }

    public function logout2(Request $request)
    {
        auth('masyarakat')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('login')->withSuccess('Anda berhasil logout!');
    }

    protected function authenticated($request, $user)
    {
        Auth::logoutOtherDevices(request('password'));
    }
}
