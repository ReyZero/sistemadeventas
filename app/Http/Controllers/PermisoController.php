<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
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
        $permisos = Permission::all();
        return view('admin.permisos.index', compact(('permisos')));
    }

    public function create()
    {
        return view('admin.permisos.create');
    }

    public function store(Request $request)
    {
        /*
        $datos = request()->all();
        return response()->json($datos);
        */
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);
        Permission::create(['name' => $request->name]);
        return redirect()->route('admin.permisos.index')
            ->with('mensaje', 'El Nuevo permiso fue agregado de la manera correcta')
            ->with('icono', 'success');
    }
    public function show($id)
    {
        $permiso = Permission::find($id);
        return view('admin.permisos.show', compact('permiso'));
    }

    public function edit($id)
    {
        $permiso = Permission::find($id);
        return view('admin.permisos.edit', compact('permiso'));
    }
    public function update(Request $request, $id)
    {
        /*
        $datos = request()->all();
        return response()->json($datos);
        */
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);

        $permiso = Permission::find($id);
        $permiso->update(['name' => $request->name]);

        return redirect()->route('admin.permisos.index')
            ->with('mensaje', 'Se realizo la modificacion en el nombre del permiso, de la manera correcta')
            ->with('icono', 'success');
    }

    public function destroy($id)
    {
        $permiso = Permission::find($id);
        $permiso->delete();

        return redirect()->route('admin.permisos.index')
            ->with('mensaje', 'Se ELIMINO el permiso de la manera correcta')
            ->with('icono', 'success');
    }
}
