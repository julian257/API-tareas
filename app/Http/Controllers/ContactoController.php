<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        $contactos = Contacto::paginate(5);
        return view('contactos.index', compact('contactos'));
    }

    public function show($id)
    {
        $contacto = Contacto::findOrFail($id);
        return view('contactos.show', compact('contacto'));
    }

    public function create()
    {
        return view('contactos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:contactos,email',
        ]);

        Contacto::create($request->all());

        return redirect()->route('contactos.index')
                         ->with('success', 'Contacto creado correctamente');
    }

    public function edit($id)
    {
        $contacto = Contacto::findOrFail($id);
        return view('contactos.edit', compact('contacto'));
    }

    public function update(Request $request, $id)
    {
        $contacto = Contacto::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:contactos,email,' . $id,
        ]);

        $contacto->update($request->all());

        return redirect()->route('contactos.index')
                        ->with('success', 'Contacto actualizado correctamente');
    }

    public function destroy($id)
    {
        Contacto::destroy($id);

        return redirect()->route('contactos.index')
                        ->with('success', 'Contacto eliminado correctamente');
    }
}
