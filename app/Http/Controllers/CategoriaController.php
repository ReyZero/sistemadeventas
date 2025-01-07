<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Empresa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
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

        $categorias = Categoria::where('id', Auth::user()->empresa_id)->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        /*
        $datos = request()->all();
        return response()->json($datos);
        
        */
        $request->validate([
            'nombre' => 'required|unique:categorias',
            'descripcion' => 'required',
        ]);

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->empresa_id = Auth::user()->empresa_id;

        $categoria->save();
        return redirect()->route('admin.categorias.index')
            ->with('mensaje', 'Se registro una Nueva Categoria correctamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //echo $id;
        $categoria = Categoria::find($id);
        return view('admin.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $categoria = Categoria::find($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        /*
        $datos = request()->all();
        return response()->json($datos);
        
        */
        $request->validate([
            'nombre' => 'required|unique:categorias,nombre,' . $id,
            'descripcion' => 'required',
        ]);

        $categoria = Categoria::find($id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->empresa_id = Auth::user()->empresa_id;
        $categoria->save();
        return redirect()->route('admin.categorias.index')
            ->with('mensaje', 'Se actualizo la Categoria de Manera Correcta')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Categoria::destroy($id);
        return redirect()->route('admin.categorias.index')
            ->with('mensaje', 'se ELIMINO la categoria de la manera correcta')
            ->with('icono', 'success');
    }

    public function reporte()
    {

        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();
        $categorias = Categoria::where('id', Auth::user()->empresa_id)->get();
        $pdf = Pdf::loadView('admin.categorias.reporte', compact('categorias', 'empresa'));
        return $pdf->stream();
    }
}
