<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $proveedores = Proveedor::all();
     $empresa = Empresa::where('id',Auth::user()->id)->first();
        return view('admin.proveedores.index', compact('proveedores','empresa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $proveedores = Proveedor::all();
        return view('admin.proveedores.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        /*

        $datos=request()->all();
        return response()->json($datos);
        */
        $request->validate([
            'empresa' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'nombre' => 'required',
            'celular' => 'required',

        ]);

        $proeedor = new Proveedor();
        $proeedor->empresa = $request->empresa;
        $proeedor->direccion = $request->direccion;
        $proeedor->telefono = $request->telefono;
        $proeedor->email = $request->email;
        $proeedor->nombre = $request->nombre;
        $proeedor->celular = $request->celular;
        $proeedor->empresa_id = Auth::user()->empresa_id;


        $proeedor->save();

        return redirect()->route('admin.proveedores.index')
            ->with('mensaje', 'Se registro al Proveedor de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //echo $id;
        $proveedor = Proveedor::find($id);
        
        return view('admin.proveedores.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        /*
         $datos = request()->all();
         return response()->json($datos);
         
         */

        $proveedor = Proveedor::find($id);
        return view('admin.proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        /*

        $datos=request()->all();
        return response()->json($datos);
        */
        $request->validate([
            'empresa' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'nombre' => 'required',
            'celular' => 'required',

        ]);

        $proveedor = Proveedor::find($id);
        $proveedor->nombre = $request->nombre;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->nombre = $request->nombre;
        $proveedor->celular = $request->celular;
        $proveedor->save();

        return redirect()->route('admin.proveedores.index')
            ->with('mensaje', 'Se Modifico el proveedor de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Proveedor::destroy($id);
        return redirect()->route('admin.proveedores.index')
            ->with('mensaje', 'el PROVEEDOR fue eliminaro de la manera correcta')
            ->with('icono', 'success');
    }
}
