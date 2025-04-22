<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierModel;
use DataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class SupplierController extends Controller
{
    public function index()
    {
        return view('suppliers.index', [
            'page' => (object)['title' => 'Data Supplier'],
            'activeMenu' => 'supplier',
            'breadcrumb' => (object)[
                'title' => 'Supplier',
                'list' => ['Home', 'Supplier']
            ]
        ]);
    }

    public function list(Request $request)
    {
        $data = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_telp');

        return FacadesDataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btn = '<a href="' . url('/supplier/' . $row->supplier_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/supplier/' . $row->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form method="POST" action="' . url('/supplier/' . $row->supplier_id) . '" class="d-inline">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Hapus data ini?\')">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('suppliers.create', [
            'page' => (object)['title' => 'Tambah Supplier'],
            'activeMenu' => 'supplier',
            'breadcrumb' => (object)[
                'title' => 'Tambah Supplier',
                'list' => ['Home', 'Supplier', 'Tambah']
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_kode' => 'required|unique:m_supplier,supplier_kode',
            'supplier_nama' => 'required',
            'supplier_alamat' => 'required',
            'supplier_telp' => 'required'
        ]);

        SupplierModel::create($request->all());

        return redirect('/supplier')->with('success', 'Data supplier berhasil ditambahkan.');
    }

    public function show($id)
    {
        $supplier = SupplierModel::find($id);

        return view('suppliers.show', [
            'supplier' => $supplier,
            'page' => (object)['title' => 'Detail Supplier'],
            'activeMenu' => 'supplier',
            'breadcrumb' => (object)[
                'title' => 'Detail Supplier',
                'list' => ['Home', 'Supplier', 'Detail']
            ]
        ]);
    }

    public function edit($id)
    {
        $supplier = SupplierModel::find($id);

        return view('suppliers.edit', [
            'supplier' => $supplier,
            'page' => (object)['title' => 'Edit Supplier'],
            'activeMenu' => 'supplier',
            'breadcrumb' => (object)[
                'title' => 'Edit Supplier',
                'list' => ['Home', 'Supplier', 'Edit']
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_kode' => 'required|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
            'supplier_nama' => 'required',
            'supplier_alamat' => 'required',
            'supplier_telp' => 'required'
        ]);

        SupplierModel::find($id)->update($request->all());

        return redirect('/supplier')->with('success', 'Data supplier berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $supplier = SupplierModel::find($id);

        try {
            $supplier->delete();
            return redirect('/supplier')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect('/supplier')->with('error', 'Data gagal dihapus.');
        }
    }
}
