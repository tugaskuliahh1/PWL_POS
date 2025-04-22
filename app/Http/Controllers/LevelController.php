<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index()
    {
        $page = (object)[
            'title' => 'Data Level'
        ];
        return view('level.index', [
            'page' => (object)[
                'title' => 'Data Level'
            ],
            'activeMenu' => 'level',
            'breadcrumb' => (object)[
                'title' => 'Level',
                'list' => ['Home', 'Level']
            ]
        ]);               
    }

    public function list(Request $request)
    {
        $data = LevelModel::select('level_id', 'level_nama');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {
                $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form method="POST" action="' . url('/level/' . $level->level_id) . '" class="d-inline-block">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin?\')">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('level.create', [
            'page' => (object)[
                'title' => 'Tambah Level'
            ],
            'activeMenu' => 'level',
            'breadcrumb' => (object)[
                'title' => 'Tambah Level',
                'list' => ['Home', 'Level', 'Tambah']
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_nama' => 'required|min:3|unique:m_level,level_nama'
        ]);

        LevelModel::create([
            'level_nama' => $request->level_nama
        ]);

        return redirect('/level')->with('success', 'Data level berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $level = LevelModel::findOrFail($id);

        return view('level.edit', [
            'page' => (object)[
                'title' => 'Edit Level'
            ],
            'activeMenu' => 'level',
            'breadcrumb' => (object)[
                'title' => 'Edit Level',
                'list' => ['Home', 'Level', 'Edit']
            ],
            'level' => $level
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'level_nama' => 'required|min:3|unique:m_level,level_nama,' . $id . ',level_id'
        ]);

        $level = LevelModel::findOrFail($id);
        $level->update([
            'level_nama' => $request->level_nama
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diperbarui.');
    }

    public function show($id)
    {
        $level = LevelModel::findOrFail($id);

        return view('level.show', [
            'page' => (object)[
                'title' => 'Detail Level'
            ],
            'activeMenu' => 'level',
            'breadcrumb' => (object)[
                'title' => 'Detail Level',
                'list' => ['Home', 'Level', 'Detail']
            ],
            'level' => $level
        ]);
    }

    public function destroy($id)
    {
        $level = LevelModel::findOrFail($id);
        $level->delete();

        return redirect('/level')->with('success', 'Data level berhasil dihapus.');
    }
}
