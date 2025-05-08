<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 't_stok'; // nama tabel di database
    protected $primaryKey = 'id'; // pastikan sesuai dengan nama kolom PK
    public $timestamps = false; // kalau tabel tidak punya created_at & updated_at
}
