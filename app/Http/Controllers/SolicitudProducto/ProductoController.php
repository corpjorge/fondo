<?php

namespace App\Http\Controllers\SolicitudProducto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Usuario\Users_detalle;
use App\Model\solicitudProducto\p_producto;
use App\Model\solicitudProducto\p_solicitud;

use App\User;
use auth;
use Validator;
use DB;
use Carbon\Carbon;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = p_producto::where('estados_id',1)->get();
        return view('adminlte::solicitud_producto.producto.index', ['productos' => $productos] ); 
         
    }

    public function actualizar()
    {
      $fecha_created_at = Carbon::now();

      //servicios url
      $url_servicios = "http://190.145.4.62/WebServices/WSEstadoCuenta.asmx/PoblarListaDesplegable?pTabla=lineasservicios&pColumnas=cod_linea_servicio,nombre&pCondicion=&pOrden=nombre";
      $response_servicios = file_get_contents($url_servicios);
      $servicios = simplexml_load_string($response_servicios);

      //Líneas administradas por cartera
      $url_cartera = "http://190.145.4.62/WebServices/WSCredito.asmx/ListaDestinacionCredito?pCod_linea_Credito=8";
      $response_cartera = file_get_contents($url_cartera);
      $cartera_lineas = simplexml_load_string($response_cartera);

      $p_productos  = p_producto::all();

      foreach ($servicios as $servicio) {
        $p_productos  = p_producto::where('name',$servicio->descripcion)->first();
        if ($p_productos == null) {

          DB::table('p_productos')->insert(
              [
                'codigo' =>$servicio->idconsecutivo,
                'name' =>  $servicio->descripcion,
                'linea' => 1,
                'created_at' =>  $fecha_created_at,
              ]
          );
        }
      }

      foreach ($cartera_lineas as $cartera) {
        $p_productos  = p_producto::where('name',$cartera->descripcion)->first();
        if ($p_productos == null) {
          DB::table('p_productos')->insert(
              [
                'codigo' => $cartera->cod_destino,
                'name' =>  $cartera->descripcion,
                'linea' =>  8,
                'created_at' =>  $fecha_created_at,
              ]
          );
        }
      }

      session()->flash('message', 'Listado actualizado');
      return redirect('solicitudes/productos/add');

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos  = p_producto::all();      
        return view('adminlte::solicitud_producto.producto.add', ['productos' => $productos]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->Validate($request,[
          'activar' => 'required',

      ]);

      for ($i=0; $i < count($request->activar); $i++) {
        DB::table('p_productos')
            ->where('id', $request->activar[$i])
            ->update(['estados_id' => 1]);
      }

      session()->flash('message', 'Listado actualizado');
      return redirect('solicitudes/productos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}