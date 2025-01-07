<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Proveedor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        //si el usuario esta autenticado, obtener la empresa y compartila en las vistas
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                //obtener la empresa segun el id de la empresa del usuario autenticado
                $empresa = Empresa::find(Auth::user()->empresa_id);
                //compartir la variable 'empresa' con todas las vistas
                view()->share('empresa', $empresa);
            }
            return $next($request);
        });
    }
    public function index()
    {
        //
        $proveedores = Proveedor::where('empresa_id', Auth::user()->id)->get();
        $empresa = Empresa::where('id', Auth::user()->id)->first();
        return view('admin.proveedores.index', compact('proveedores', 'empresa'));
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

    public function reporte()
    {

        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();
        $proveedores = Proveedor::where('empresa_id', Auth::user()->id)->get();
        $pdf = Pdf::loadView('admin.proveedores.reporte', compact('proveedores', 'empresa'))
            ->setPaper('letter', 'landscape');
        return $pdf->stream();
    }
}
