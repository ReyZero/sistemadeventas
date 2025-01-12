<?php

namespace App\Http\Controllers;

use App\Models\Arqueo;
use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\Empresa;
use App\Models\MovimientoCaja;
use App\Models\Producto;
use App\Models\TmpVenta;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nnjeim\World\Models\Currency;
use NumberToWords\NumberToWords;
use NumberFormatter;

class VentaController extends Controller
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

        //Bloquear boton de ventas sin arqueo iniciado
        $arqueoAbierto = Arqueo::whereNull('fecha_cierre')->where('empresa_id', Auth::user()->empresa_id)->first();

        $ventas = Venta::with('detalleVenta', 'cliente')->where('empresa_id', Auth::user()->empresa_id)->get();
        return view('admin.ventas.index', compact('ventas', 'arqueoAbierto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->get();

        $session_id = session()->getId();
        $tmp_ventas = TmpVenta::where('session_id', $session_id)->get();

        $session_id = session()->getId();
        return view('admin.ventas.create', compact('productos', 'clientes', 'tmp_ventas'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function cliente_store(Request $request)
    {
        $validate = $request->validate([
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
        $cliente->empresa_id = Auth::user()->empresa_id;
        $cliente->save();

        return response()->json(['success' => 'Datos o clientes Registrados']);
    }
    public function store(Request $request)
    {
        //
        /*
        $datos = request()->all();
        return response()->json($datos);

        */

        $request->validate([
            'fecha' => 'required',
            'precio_total' => 'required'
        ]);
        $precioTotalVenta = str_replace('.', '', $request->precio_total); // Elimina los puntos
        $precioTotal = floatval($precioTotalVenta); // Convierte el valor a tipo float

        $TotalVenta = str_replace('.', '', $request->total_venta); // Elimina los puntos
        $ptotal = floatval($TotalVenta); // Convierte el valor a tipo float
        $session_id = session()->getId();

        $venta = new Venta();
        $venta->fecha = $request->fecha;
        $venta->precio_total =number_format($precioTotal,2,'.','');
        $venta->empresa_id = Auth::user()->empresa_id;
        $venta->cliente_id = $request->cliente_id;
        $venta->save();


        /*REGISTRAR EN EL ARQUEO INGRESO */
        $arqueo_id = Arqueo::whereNull('fecha_cierre')->where('empresa_id', Auth::user()->empresa_id)->first();
        $movimiento = new MovimientoCaja();
        $movimiento->tipo = "INGRESO";
        $movimiento->monto = number_format($ptotal,0,'.', '');
        $movimiento->descripcion = "VENTA DE PRODUCTOS";
        $movimiento->arqueo_id = $arqueo_id->id;

        $movimiento->save();

        /*REGISTRAR EN EL ARQUEO */

        $tmp_ventas = TmpVenta::where('session_id', $session_id)->get();

        foreach ($tmp_ventas as $tmp_venta) {

            # code...
            $producto = Producto::where('id', $tmp_venta->producto_id)->first();
            $detalle_venta = new DetalleVenta();
            $detalle_venta->cantidad = $tmp_venta->cantidad;

            $detalle_venta->venta_id  = $venta->id;
            $detalle_venta->producto_id = $tmp_venta->producto_id;

            $detalle_venta->save();

            $producto->stock -= $tmp_venta->cantidad;
            $producto->save();
        }

        TmpVenta::where('session_id', $session_id)->delete();

        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'Venta fue realizada exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Display the specified resource.
     */

    public function pdf($id)
    {
        //echo $id;
        function numeroALetrasConDecimales($numero)
        {
            $formatter = new NumberFormatter('es', NumberFormatter::SPELLOUT);

            $partes = explode('.', number_format($numero, 2, '.', ''));

            $entero = $formatter->format($partes[0]);
            $decimal = $formatter->format($partes[1]);

            return ucfirst("$entero con $decimal");
        }
        /*
*/


        $id_empresa = Auth::user()->empresa_id;
        $empresa = Empresa::where('id', $id_empresa)->first();
        $moneda = Currency::find($empresa->moneda);
        $moneda->symbol;
        $ventas = Venta::with('detalleVenta', 'cliente')->findOrFail($id);

        $numero = $ventas->precio_total;
        $literal = numeroALetrasConDecimales($numero);




        $pdf = PDF::loadView('admin.ventas.pdf', compact('empresa', 'ventas', 'moneda', 'literal'));
        return $pdf->stream();
    }



    public function show($id)
    {
        // echo $id;
        $ventas = Venta::with('detalleVenta', 'cliente')->findOrFail($id);
        return view('admin.ventas.show', compact('ventas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //echo ($id);
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->get();
        $venta = Venta::with('detalleVenta', 'cliente')->findOrFail($id);
        return view('admin.ventas.edit', compact('venta', 'productos', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        /*
        $datos= request()->all();
        return response()->json($datos);
        */
        request()->validate([
            'fecha' => 'required',
            'precio_total' => 'required',
        ]);
        $precioTotalVenta = str_replace('.', '', $request->precio_total); // Elimina los puntos
        $precioTotal = floatval($precioTotalVenta); // Convierte el valor a tipo float

        $venta = Venta::findOrFail($id);
        $venta->fecha = $request->fecha;
        $venta->precio_total = number_format($precioTotal,2,'.','');
        $venta->cliente_id = $request->cliente_id;
        $venta->empresa_id = Auth::user()->empresa_id;
        $venta->save();

        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'Se Modifico la venta de forma correcta')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        echo $id;
        $venta = Venta::find($id);

        foreach ($venta->detalleVenta as $detalle) {
            # code...
            $producto = Producto::find($detalle->producto_id);
            $producto->stock += $detalle->cantidad;
            $producto->save();
        }
        $venta->detalleVenta()->delete();

        Venta::destroy($id);
        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'Se ELIMINO!!! la venta de la manera correcta')
            ->with('icono', 'success');
    }

    public function reporte()
    {

        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();
        $ventas = Venta::with('cliente')->where('empresa_id', Auth::user()->empresa_id)->get();
        $pdf = Pdf::loadView('admin.ventas.reporte', compact('ventas', 'empresa'))
            ->setPaper('letter', 'landscape');
        return $pdf->stream();
    }
}
