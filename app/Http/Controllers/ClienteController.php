<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{

    public function index(Request $request)
    {
        $query = Cliente::where('user_id', Auth::id());

        if ($request->filled('dni')) {
            $query->where('dni', 'like', '%' . $request->dni . '%');
        }

        $clientes = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return view('clientes.partials.table', compact('clientes'))->render();
        }

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|max:255|unique:clientes,dni',
            'asesorado' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ], [
            'dni.unique' => 'El DNI ingresado ya existe en la base de datos.',
        ]);


        $duracion = ($request->asesorado === 'w3') ? 3 : 7;

        Cliente::create([
            'dni' => $request->dni,
            'asesorado' => $request->asesorado,
            'telefono' => $request->telefono,
            'user_id' => Auth::id(),
            'duracion' => $duracion,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'dni' => 'required|string|max:255|unique:clientes,dni,' . $cliente->id,
            'asesorado' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ], [
            'dni.unique' => 'El DNI ingresado ya existe en la base de datos.',
        ]);

        $duracion = ($request->asesorado === 'w3') ? 3 : 7;

        $cliente->update([
            'dni' => $request->dni,
            'asesorado' => $request->asesorado,
            'telefono' => $request->telefono,
            'duracion' => $duracion,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
