<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LevelModel;

class LevelController extends Controller
{
    public function index()
    {
        return LevelModel::all();
    }

    public function store(Request $request)
    {
        $level = LevelModel::create($request->all());
        return response()->json($level, 201);
    }

    public function show(LevelModel $level)
    {
        return LevelModel::find($level);
    }

    public function update(Request $request, $id)
    {
        $level = LevelModel::find($id);
        if (!$level) {
            return response()->json(['message' => 'Level not found'], 404);
        }

        $level->level_kode = $request->input('level_kode');
        $level->save();

        return response()->json(['message' => 'Level updated', 'data' => $level]);
    }


    public function destroy(LevelModel $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}
