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
            'username' => 'customer-1',
            'nama' => 'Pelanggan',
            'password' => hash::make('12345'),
            'level_id' => 4
        ];
        UserModel::insert($data);
        
        $user = UserModel::all(); // Ambil semua data dari tabel m_user
        return view('user', ['data' => $user]); // Kirim data ke view user.blade.php
    }
}
