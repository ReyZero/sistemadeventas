<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Retornar los paises y otros para que aparezcan desde la BD los datos 

        $paises = DB::table('countries')->get();
        $estados = DB::table('states')->get();
        $ciudades = DB::table('cities')->get();
        $monedas = DB::table('currencies')->get();
        // dd($paises); // Esto mostrará los datos antes de cargar la vista
        return view('admin.empresas.create', compact('paises', 'estados', 'ciudades', 'monedas'));
    }

    public function buscar_estado($id_pais)
    {
        //echo $id_pais;
        try {
            //code...
            //consultado paises para saber estados y otros
            $estados = DB::table('states')->where('country_id', $id_pais)->get();
            return view('admin.empresas.cargar_estados', compact('estados'));
        } catch (\Exception $exception) {
            //throw $th;
            return response()->json(['mensaje' => 'Error']);
        }
    }
    public function buscar_ciudad($id_estado)
    {
        try {
            //code...
            $ciudades = DB::table('cities')->where('state_id', $id_estado)->get();
            return view('admin.empresas.cargar_ciudades', compact('ciudades'));
        } catch (\Exception $exception) {
            //throw $th;
            return response()->json(['mensaje' => 'Error']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
        $datos= $request->all();
        return response()->json($datos);
        */

        // Validar los datos
        $request->validate([
            'nombre_empresa' => 'required',
            'tipo_empresa' => 'required',
            'nit' => 'required|unique:empresas',
            'telefono' => 'required',
            'correo' => 'required|unique:empresas',
            'cantidad_impuesto' => 'required',
            'nombre_impuesto' => 'required',
            'direccion' => 'required',
            'logo' => 'required|image|mimes:jpg,jpeg,png', // Este puede ser temporal si no lo usas aún
        ]);

        // Crear una nueva instancia de Empresa
        $empresa = new Empresa();

        // Asignar valores
        $empresa->pais = $request->pais;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->nit = $request->nit;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->cantidad_impuesto = $request->cantidad_impuesto;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->direccion = $request->direccion;
        $empresa->moneda = $request->moneda; // Asegúrate de que este campo esté en el formulario
        $empresa->ciudad = $request->ciudad;
        $empresa->departamento = $request->departamento;
        $empresa->codigo_postal = $request->codigo_postal;
        // Manejar la imagen si decides hacerlo más adelante
        // Guardar el archivo
        if ($request->hasFile('logo')) {
            $empresa->logo = $request->file('logo')->store('logos', 'public');
        }

        // Guardar en la base de datos
        $empresa->save();

        // crear un usuario para el sistema
        $usuario = new User();
        $usuario->name = "Admin";
        $usuario->email = $request->correo;
        $usuario->password = Hash::make($request['nit']);
        $usuario->empresa_id = $empresa->id;
        $usuario->save();

        //Da acceso automaticamente al usuario
        Auth::login($usuario);

        return redirect()->route('admin.index')
            ->with('mensaje', 'Se registro la empresa de la manra correcta');

        /* try {
            } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo guardar la empresa: ' . $e->getMessage()], 400);
        }
*/
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
        $paises = DB::table('countries')->get();
        $estados = DB::table('states')->get();
        //$ciudades = DB::table('cities')->get();
        $monedas = DB::table('currencies')->get();
        $empresa_id = Auth::user()->empresa_id;
        $empresa = Empresa::where('id', $empresa_id)->first();
        $departamentos = DB::table('states')->where('country_id', $empresa->pais)->get();
        $ciudades = DB::table('cities')->where('state_id', $empresa->departamento)->get();
        return view('admin.configuraciones.edit', compact('paises', 'estados', 'ciudades', 'monedas', 'empresa', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        /*
        $datos = request()->all();
        return response()->json($datos);
        */

        // Validar los datos
        $request->validate([
            'nombre_empresa' => 'required',
            'tipo_empresa' => 'required',
            'nit' => 'required|unique:empresas,nit,'.$id,
            'telefono' => 'required',
            'correo' => 'required|unique:empresas,correo,'.$id,
            'cantidad_impuesto' => 'required',
            'nombre_impuesto' => 'required',
            'direccion' => 'required',
        ]);

        // Crear una nueva instancia de Empresa
        $empresa = Empresa::find($id);

        // Asignar valores
        $empresa->pais = $request->pais;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->nit = $request->nit;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->cantidad_impuesto = $request->cantidad_impuesto;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->direccion = $request->direccion;
        $empresa->moneda = $request->moneda; // Asegúrate de que este campo esté en el formulario
        $empresa->ciudad = $request->ciudad;
        $empresa->departamento = $request->departamento;
        $empresa->codigo_postal = $request->codigo_postal;
        // Manejar la imagen si decides hacerlo más adelante
        // Actualizar el archivo
        if ($request->hasFile('logo')) {
            storage::delete('public/' . $empresa->logo);
            $empresa->logo = $request->file('logo')->store('logos', 'public');
        }

        // Guardar en la base de datos
        $empresa->save();

        $usuario_id = Auth::user()->id;
        // Actualizar un usuario para el sistema
        $usuario = User::find($usuario_id) ;
        $usuario->name = "Admin";
        $usuario->email = $request->correo;
        $usuario->password = Hash::make($request['nit']);
        $usuario->empresa_id = $empresa->id;
        $usuario->save();

        //Da acceso automaticamente al usuario
         

        return redirect()->route('admin.index')
            ->with('mensaje', 'Se Actualizo los datos de la empresa de la Manera correcta')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
