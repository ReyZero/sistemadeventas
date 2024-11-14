<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\detalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\TmpCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $compras = Compra::with('detalles', 'proveedor')->get();
        return view('admin.compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();

        $session_id = session()->getId();
        $tmp_compras = TmpCompra::where('session_id', $session_id)->get();

        return view('admin.compras.create', compact('productos', 'proveedores', 'tmp_compras'));
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
            'fecha' => 'required',
            'comprobante' => 'required',
            'precio_total' => 'required'
        ]);

        $session_id = session()->getId();

        $compra = new Compra();
        $compra->fecha = $request->fecha;
        $compra->comprobante = $request->comprobante;
        $compra->precio_total = $request->precio_total;
        $compra->proveedores_id = $request->proveedor_id;
        $compra->empresa_id = Auth::user()->empresa_id;
        $compra->save();

        $tmp_compras = TmpCompra::where('session_id', $session_id)->get();

        foreach ($tmp_compras as $tmp_compra) {

            # code...
            $producto = Producto::where('id', $tmp_compra->producto_id)->first();
            $detalle_compra = new detalleCompra();
            $detalle_compra->cantidad = $tmp_compra->cantidad;

            $detalle_compra->compra_id = $compra->id;
            $detalle_compra->producto_id = $tmp_compra->producto_id;

            $detalle_compra->save();

            $producto->stock += $tmp_compra->cantidad;
            $producto->save();
        }

        TmpCompra::where('session_id', $session_id)->delete();

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Compra fue realizada exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //echo $id;


        $compra = Compra::with('detalles', 'proveedor')->findOrFail($id);

        return view('admin.compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //echo $id;

        $compra = Compra::with('detalles', 'proveedor')->findOrFail($id);

        $proveedores = Proveedor::all();
        $productos = Producto::all();

        return view('admin.compras.edit', compact('compra', 'proveedores', 'productos'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        /*
        $datos = request()->all();
        return response()->json($datos);
        */
        $request->validate([
            'fecha' => 'required',
            'comprobante' => 'required',
            'precio_total' => 'required'
        ]);



        $compra = Compra::find($id);
        $compra->fecha = $request->fecha;
        $compra->comprobante = $request->comprobante;
        $compra->precio_total = $request->precio_total;
        $compra->proveedores_id = $request->proveedor_id;
        $compra->empresa_id = Auth::user()->empresa_id;

        $compra->save();

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Se modifico la compra de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $compra = Compra::find($id);
        foreach ($compra->detalles as $detalle) {
            # code...
            $producto = Producto::find($detalle->producto_id);
            $producto->stock -= $detalle->cantidad;
            $producto->save();
        }

        $compra->detalles()->delete();

        $compra->delete();

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'La COMPRA FUE ELIMINADA !!! de manera correcta')
            ->with('icono', 'success');
    }
}
