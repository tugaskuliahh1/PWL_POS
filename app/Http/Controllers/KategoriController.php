<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel; // Pastikan Anda memiliki model KategoriModel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    // Menampilkan halaman awal kategori
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object)[
            'title' => 'Daftar kategori barang dalam sistem'
        ];

        $activeMenu = 'kategori';

        return view('kategori.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // Ambil data kategori dalam bentuk json untuk datatables 
    public function list(Request $request)
    {
        $data = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '
                    <button onclick="modalAction(\''.url("/kategori/{$row->kategori_id}/show_ajax").'\')" class="btn btn-info btn-sm">Detail</button>
                    <button onclick="modalAction(\''.url("/kategori/{$row->kategori_id}/edit_ajax").'\')" class="btn btn-warning btn-sm">Edit</button>
                    <button onclick="modalAction(\''.url("/kategori/{$row->kategori_id}/delete_ajax").'\')" class="btn btn-danger btn-sm">Hapus</button>
                ';
            })            
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan halaman form tambah kategori
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah kategori baru'
        ];

        $activeMenu = 'kategori';

        return view('kategori.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data kategori baru
    // Menyimpan data kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'kategori_nama' => 'required|string|min:3|max:100'
        ]);

        $lastId = KategoriModel::count() + 1;
        $kodeKategori = 'KTG' . str_pad($lastId, 3, '0', STR_PAD_LEFT);

        KategoriModel::create([
            'kategori_kode' => $kodeKategori,
            'kategori_nama' => $request->kategori_nama
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan');
    }

    // Menampilkan detail kategori
    public function show(string $id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan halaman form edit kategori
    public function edit(string $id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data kategori
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_nama' => 'required|string|min:3|max:100'
        ]);

        KategoriModel::find($id)->update([
            'kategori_nama' => $request->kategori_nama
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
    }

    // Menghapus data kategori
    public function destroy(string $id)
    {
        $check = KategoriModel::find($id);
        if (!$check) {
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
        }
    
        try {
            KategoriModel::destroy($id);
            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terkait dengan data lain');
        }
    }
    
    // ================== AJAX ===================
    
    public function create_ajax()
    {
        return view('kategori.create_ajax');
    }
    
    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'kategori_kode' => 'required|min:2|max:10|unique:m_kategori,kategori_kode',
                'kategori_nama' => 'required|min:3|max:100'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            KategoriModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data kategori berhasil disimpan'
            ]);
        }

        return redirect('/');
    }

    public function show_ajax($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.show_ajax', compact('kategori'));
    }

    public function edit_ajax($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit_ajax', compact('kategori'));
    }
    
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $rules = [
                'kategori_kode' => 'required|min:2|max:10|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
                'kategori_nama' => 'required|min:3|max:100'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $kategori = KategoriModel::find($id);
            $kategori->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data kategori berhasil diupdate'
            ]);
        }

        return redirect('/');
    }
    
    public function confirm_ajax($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.confirm_ajax', compact('kategori'));
    }
    
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $kategori = KategoriModel::find($id);
            $kategori->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data kategori berhasil dihapus'
            ]);
        }

        return redirect('/');
    }
}