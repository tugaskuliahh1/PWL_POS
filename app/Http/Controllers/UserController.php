<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() // Tambahkan method index
    {
        $data = [
            'level_id' => 2,
            'username' => 'manager_tiga',
            'nama' => 'Manager 3',
            'password' => hash::make('12345')
        ];
        UserModel::create($data);
        
        $user = UserModel::all(); // Ambil semua data dari tabel m_user
        return view('user', ['data' => $user]); // Kirim data ke view user.blade.php
    }
}
