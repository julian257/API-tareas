<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        return Tarea::all();
    }

    public function store(Request $request)
    {
        return Tarea::create($request->all());
    }

    public function show($id)
    {
        return Tarea::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->all());
        return $tarea;
    }

    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
        return response()->json(['message' => 'Eliminado']);
    }
}
