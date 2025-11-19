<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        return Contacto::all();
    }

    public function store(Request $request)
    {
        return Contacto::create($request->all());
    }

    public function show($id)
    {
        return Contacto::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $c = Contacto::findOrFail($id);
        $c->update($request->all());
        return $c;
    }

    public function destroy($id)
    {
        $c = Contacto::findOrFail($id);
        $c->delete();
        return response()->json(['message' => 'Eliminado']);
    }
}
