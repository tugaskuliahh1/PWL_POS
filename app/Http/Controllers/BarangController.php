<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)['title' => 'Daftar Barang', 'list' => ['Home', 'Barang']];
        $page = (object)['title' => 'Daftar barang dalam sistem'];
        $activeMenu = 'barang';

        $kategori = KategoriModel::all();

        return view('barang.index', compact('breadcrumb', 'page', 'activeMenu', 'kategori'));
    }

    public function list(Request $request)
    {
        $barang = BarangModel::with('kategori')->select(
            'barang_id',
            'barang_kode',
            'barang_nama',
            'kategori_id',
            'harga_beli',
            'harga_jual',
            'created_at',
            'updated_at'
        );
    
        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('kategori_nama', function($row) {
                return $row->kategori ? $row->kategori->kategori_nama : '-';
            })
            ->addColumn('aksi', function($row) {
                return '
                    <button onclick="modalAction(\''.url("/barang/$row->barang_id/show_ajax").'\')" class="btn btn-info btn-sm">Detail</button>
                    <button onclick="modalAction(\''.url("/barang/$row->barang_id/edit_ajax").'\')" class="btn btn-warning btn-sm">Edit</button>
                    <button onclick="modalAction(\''.url("/barang/$row->barang_id/delete_ajax").'\')" class="btn btn-danger btn-sm">Hapus</button>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }    

    public function create_ajax()
    {
        $kategori = KategoriModel::all();
        return view('barang.create_ajax', compact('kategori'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'barang_kode' => 'required|min:2|max:10|unique:m_barang,barang_kode',
                'barang_nama' => 'required|string|min:3|max:100',
                'kategori_id' => 'required|integer',
                'satuan' => 'required|string|max:20',
                'harga_beli' => 'required|numeric',
                'harga_jual' => 'required|numeric',
                'stok' => 'required|integer',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi gagal', 'msgField' => $validator->errors()]);
            }

            BarangModel::create($request->all());

            return response()->json(['status' => true, 'message' => 'Data barang berhasil disimpan']);
        }
        return redirect('/');
    }

    public function edit_ajax($id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();
        return view('barang.edit_ajax', compact('barang', 'kategori'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $rules = [
                'barang_kode' => 'required|min:2|max:10|unique:m_barang,barang_kode,' . $id . ',barang_id',
                'barang_nama' => 'required|string|min:3|max:100',
                'kategori_id' => 'required|integer',
                'satuan' => 'required|string|max:20',
                'harga_beli' => 'required|numeric',
                'harga_jual' => 'required|numeric',
                'stok' => 'required|integer',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi gagal', 'msgField' => $validator->errors()]);
            }

            $barang = BarangModel::find($id);
            $barang->update($request->all());

            return response()->json(['status' => true, 'message' => 'Data barang berhasil diupdate']);
        }
        return redirect('/');
    }

    public function confirm_ajax($id)
    {
        $barang = BarangModel::find($id);
        return view('barang.confirm_ajax', compact('barang'));
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $barang = BarangModel::find($id);
            $barang->delete();

            return response()->json(['status' => true, 'message' => 'Data barang berhasil dihapus']);
        }
        return redirect('/');
    }

    public function show_ajax($id)
    {
        $barang = BarangModel::with('kategori')->find($id);
        return view('barang.show_ajax', compact('barang'));
    }
}
