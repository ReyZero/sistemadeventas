<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
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
        $productos = Producto::with('categoria')->where('empresa_id', Auth::user()->empresa_id)->get();
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categoria::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        /*
        $datos =request()->all();
        return response()->json($datos);
        
        */
        $request->validate([
            'codigo' => 'required|unique:productos,codigo',
            'nombre' => 'required',
            'stock' => 'required',
            'stock_minimo' => 'required',
            'stock_maximo' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'fecha_ingreso' => 'required',


        ]);
        $precioproducto = str_replace('.', '', $request->precio_venta); // Elimina los puntos
        $precioprudctoventa = floatval($precioproducto); // Convierte el valor a tipo float
        $producto = new Producto();

        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = number_format($precioprudctoventa,2,'.','');
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->categoria_id = $request->categoria_id;
        $producto->empresa_id = Auth::user()->empresa_id;

        //Tratamiento de imagen
        if ($request->hasFile('imagen')) {

            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto->save();
        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'El Producto se agrego de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // echo $id;
        $producto = Producto::find($id);
        return view('admin.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //echo $id;
        $producto = Producto::find($id);
        $categorias = Categoria::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        /*
        $datos =request()->all();
        return response()->json($datos);
        */

        $request->validate([
            'codigo' => 'required|unique:productos,codigo,' . $id,
            'nombre' => 'required',
            'stock' => 'required',
            'stock_minimo' => 'required',
            'stock_maximo' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'fecha_ingreso' => 'required',
        ]);

        $precioTotalCompra = str_replace('.', '', $request->precio_compra); // Elimina los puntos
        $precioTotalCom = floatval($precioTotalCompra); // Convierte el valor a tipo float
        $precioTotalVenta = str_replace('.', '', $request->precio_venta); // Elimina los puntos
        $precioTotalVen = floatval($precioTotalVenta); // Convierte el valor a tipo float

        $producto = Producto::find($id);

        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->precio_compra = number_format($precioTotalCom, 2, '.', '');
        $producto->precio_venta = number_format($precioTotalVen, 2, '.', '');
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->categoria_id = $request->categoria_id;
        $producto->empresa_id = Auth::user()->empresa_id;

        //Tratamiento de imagen
        if ($request->hasFile('imagen')) {
            Storage::delete('public/' . $producto->imagen);
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }
        $producto->save();

        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'El producto fue actualizado de manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $producto = Producto::find($id);
        Producto::destroy($id);
        //Eliminar la imagen del sistema 
        Storage::delete('public/' . $producto->imagen);
        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'Se elimino el producto de la manera correcta')
            ->with('icono', 'success');
    }

    public function reporte()
    {

        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        $pdf = PDF::loadView('admin.productos.reporte', compact('productos', 'empresa'))
            ->setPaper('letter', 'landscape');

        return $pdf->stream();
    }
}
