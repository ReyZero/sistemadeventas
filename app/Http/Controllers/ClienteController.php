<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clientes = Cliente::all();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        /*
        return response()->json($datos);
        $datos = request()->all();
        */
        $request->validate([
            'nombre_cliente' => 'required',
            'nit_codigo' => 'required',
            'telefono' => 'required',
            'email' => 'required',
        ]);

        $cliente = new Cliente();
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->nit_codigo = $request->nit_codigo;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->empresa_id =Auth::user()->empresa_id;

        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'El Cliente fue registrado de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //echo ($id);
        $clientes = Cliente::find($id);
        return view('admin.clientes.show', compact('clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $clientes = Cliente::find($id);
        return view('admin.clientes.edit', compact('clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        /*
        $datos= request()->all();
        return response ()->json($datos);
        */
        $request->validate([
            'nombre_cliente' => 'required',
            'nit_codigo' => 'required',
            'telefono' => 'required',
            'email' => 'required',
        ]);
        $cliente = Cliente::find($id);
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->nit_codigo = $request->nit_codigo;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->empresa_id =Auth::user()->empresa_id;
        
        $cliente->save();
        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'El Cliente fue modificado de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Cliente::destroy($id);
        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'El Cliente fue ELIMINADO !!! de la manera correcta')
            ->with('icono', 'success');
    }
}