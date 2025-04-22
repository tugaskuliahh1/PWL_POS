<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\SupplierModel;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        return view('barang.index', [
            'page' => (object)['title' => 'Data Barang'],
            'activeMenu' => 'barang',
            'breadcrumb' => (object)[
                'title' => 'Data Barang',
                'list' => ['Master', 'Barang']
            ]
        ]);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = BarangModel::with(['kategori', 'supplier'])->select(
                'barang_id', 'barang_kode', 'barang_nama',
                'kategori_id', 'supplier_id', 'harga_beli', 'harga_jual', 'stok'
            );

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kategori', fn($b) => $b->kategori->kategori_nama ?? '-')
                ->addColumn('supplier', fn($b) => $b->supplier->supplier_nama ?? '-')
                ->addColumn('aksi', function ($b) {
                    return '
                        <a href="'.url('/barang/' . $b->barang_id).'" class="btn btn-info btn-sm">Detail</a>
                        <a href="'.url('/barang/' . $b->barang_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a>
                        <form method="POST" action="'.url('/barang/' . $b->barang_id).'" style="display:inline-block">
                            '.csrf_field().method_field('DELETE').'
                            <button class="btn btn-danger btn-sm" onclick="return confirm(\'Hapus data ini?\')">Hapus</button>
                        </form>
                    ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function create()
    {
        $page = (object)['title' => 'Tambah Barang'];
        $kategori = KategoriModel::all();
        $supplier = SupplierModel::all();

        return view('barang.create', compact('page', 'kategori', 'supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required',
            'barang_nama' => 'required',
            'kategori_id' => 'required',
            'supplier_id' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer'
        ]);

        BarangModel::create($request->all());

        return redirect('barang')->with('success', 'Data barang berhasil disimpan');
    }

    public function show(string $id)
    {
        $page = (object)['title' => 'Detail Barang'];
        $barang = BarangModel::with(['kategori', 'supplier'])->findOrFail($id);

        return view('barang.show', compact('page', 'barang'));
    }

    public function edit(string $id)
    {
        $page = (object)['title' => 'Edit Barang'];
        $barang = BarangModel::findOrFail($id);
        $kategori = KategoriModel::all();
        $supplier = SupplierModel::all();

        return view('barang.edit', compact('page', 'barang', 'kategori', 'supplier'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required',
            'barang_nama' => 'required',
            'kategori_id' => 'required',
            'supplier_id' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer'
        ]);

        $barang = BarangModel::findOrFail($id);
        $barang->update($request->all());

        return redirect('barang')->with('success', 'Data barang berhasil diupdate');
    }

    public function destroy(string $id)
    {
        BarangModel::destroy($id);
        return redirect('barang')->with('success', 'Data barang berhasil dihapus');
    }
}
