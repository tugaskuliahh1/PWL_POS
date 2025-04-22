<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use DataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori.index', [
            'page' => (object)['title' => 'Data Kategori'],
            'activeMenu' => 'kategori',
            'breadcrumb' => (object)[
                'title' => 'Kategori',
                'list' => ['Home', 'Kategori']
            ]
        ]);
    }

    public function list(Request $request)
    {
        $data = KategoriModel::select('kategori_id', 'kategori_nama');
        return FacadesDataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                $btn = '<a href="'.url('/kategori/'.$kategori->kategori_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/kategori/'.$kategori->kategori_id.'/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form method="POST" action="'.url('/kategori/'.$kategori->kategori_id).'" class="d-inline-block">'
                    .csrf_field().method_field('DELETE').
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin?\')">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('kategori.create', [
            'page' => (object)['title' => 'Tambah Kategori'],
            'activeMenu' => 'kategori',
            'breadcrumb' => (object)[
                'title' => 'Tambah Kategori',
                'list' => ['Home', 'Kategori', 'Tambah']
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_nama' => 'required|min:3|unique:m_kategori,kategori_nama'
        ]);

        KategoriModel::create(['kategori_nama' => $request->kategori_nama]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kategori = KategoriModel::find($id);

        return view('kategori.show', [
            'kategori' => $kategori,
            'page' => (object)['title' => 'Detail Kategori'],
            'activeMenu' => 'kategori',
            'breadcrumb' => (object)[
                'title' => 'Detail Kategori',
                'list' => ['Home', 'Kategori', 'Detail']
            ]
        ]);
    }

    public function edit($id)
    {
        $kategori = KategoriModel::find($id);

        return view('kategori.edit', [
            'kategori' => $kategori,
            'page' => (object)['title' => 'Edit Kategori'],
            'activeMenu' => 'kategori',
            'breadcrumb' => (object)[
                'title' => 'Edit Kategori',
                'list' => ['Home', 'Kategori', 'Edit']
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_nama' => 'required|min:3|unique:m_kategori,kategori_nama,' . $id . ',kategori_id'
        ]);

        KategoriModel::find($id)->update([
            'kategori_nama' => $request->kategori_nama
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriModel::find($id);

        try {
            $kategori->delete();
            return redirect('/kategori')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect('/kategori')->with('error', 'Gagal menghapus data.');
        }
    }
}
