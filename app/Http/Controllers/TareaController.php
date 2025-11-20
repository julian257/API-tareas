<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        return response()->json(Tarea::all());
    }

    public function store(Request $request)
    {
        $tarea = Tarea::create($request->all());
        return response()->json($tarea, 201);
    }

    public function show($id)
    {
        return response()->json(Tarea::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->all());
        return response()->json($tarea);
    }

    public function destroy($id)
    {
        Tarea::destroy($id);
        return response()->json(null, 204);
    }
}
