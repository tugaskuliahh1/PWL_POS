<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check()){ // jika sudah login, maka redirect ke halaman home
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->only('username', 'password');
    
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
    
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();    
        return redirect('login');
    }

        /**
     * Menampilkan halaman register
     */
    public function register()
    {
        // Cek apakah user sudah login
        if(Auth::check()){
            // Jika sudah login, redirect ke halaman home
            return redirect('/');
        }

        // Ambil data level untuk dropdown
        $levels = LevelModel::all();

        // Jika belum login, tampilkan halaman register
        return view('auth.register', compact('levels'));
    }

    /**
     * Memproses request register
     */
    public function postregister(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username'  => 'required|min:4|max:20|unique:m_user,username',
            'nama'      => 'required|min:4|max:100',
            'password'  => 'required|min:6|max:20|confirmed',
            'level_id'  => 'required|exists:m_level,level_id'
        ]);

        // Jika validasi gagal
        if($validator->fails()) {
            if($request->ajax() || $request->wantsJson()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            return redirect('register')
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // Buat user baru
        $user = new UserModel();
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password);
        $user->level_id = $request->level_id;
        $user->save();

        // Redirect ke halaman login dengan pesan sukses
        if($request->ajax() || $request->wantsJson()){
            return response()->json([
                'status' => true,
                'message' => 'Registrasi Berhasil',
                'redirect' => url('login')
            ]);
        }

        return redirect('login')->with('success', 'Registrasi berhasil, silahkan login');
    }
}

