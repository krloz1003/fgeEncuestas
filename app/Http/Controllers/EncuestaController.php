<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuesta;

class EncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('encuesta.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $before = \Carbon\Carbon::now()->addDays(1)->format('d/m/Y');
        $after = \Carbon\Carbon::now()->subYear(150)->format('d/m/Y');

        $rules = [
            'folio' => 'required|unique:encuestas,folio',
            'fecha_registro' => 'required|date_format:d/m/Y|after:'.$after.'|before:'.$before,
		];

        $request->validate($rules);

        $encuesta = new \App\Models\Encuesta;
        $encuesta->folio                        = $request->folio;
        $encuesta->fecha_registro               = $request->fecha_registro;
        $encuesta->recepcion_atencion           = $request->recepcion_atencion;
        $encuesta->recepcion_tiempo_espera      = $request->recepcion_tiempo_espera;
        $encuesta->tramite_realizado            = $request->tramite_realizado;
        $encuesta->id_servidor_publico          = $request->id_servidor_publico;
        $encuesta->id_tipo_servidor_publico     = $request->id_tipo_servidor_publico;
        $encuesta->servidor_atencion            = $request->servidor_atencion;
        $encuesta->servidor_tiempo_atencion     = $request->servidor_tiempo_atencion;
        $encuesta->observaciones                = $request->observaciones;
        $encuesta->save();

        return response()->json(['message' => 'Los datos se almacenarón correctamente.']);
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

    public function graficas()
    {
        return view('encuesta.graficas');
    }

    public function getEncuestas()
    {
        $encuestas = \App\Models\Encuesta::orderBy('created_at', 'desc')
                                            ->limit(5)
                                            ->get();

        return response()->json($encuestas);
    }

    public function getAllEncuestas()
    {
        $encuestas = \App\Models\Encuesta::orderBy('created_at', 'desc')
                                            ->get();
        foreach ($encuestas as $key => $value) {
            $data[] = array(
                'folio' => $value->folio,
                'fecha_registro' => $value->fecha_registro,
                'recepcion_atencion' => $value->recepcion_atencion,
                'recepcion_tiempo_espera' => $value->recepcion_tiempo_espera,
                'tramite_realizado' => $value->tramite_realizado,
                'servidor_publico' => $value->servidor->nombre,
                'tipo_servidor_publico' => $value->tipoServidor->nombre,
                'servidor_atencion' => $value->servidor_atencion,
                'servidor_tiempo_atencion' => $value->servidor_tiempo_atencion,
                'observaciones' => $value->observaciones,
            );
        }

        return response()->json($data);
    }

    public function getDataEstadistica()
    {        
        $recepcionExcelente[0]   = Encuesta::where('recepcion_atencion', 'EXCELENTE')->count();
        $recepcionExcelente[1]   = Encuesta::where('recepcion_tiempo_espera', 'EXCELENTE')->count();
        $recepcionBuena[0]       = Encuesta::where('recepcion_atencion', 'BUENA')->count();
        $recepcionBuena[1]       = Encuesta::where('recepcion_tiempo_espera', 'BUENA')->count();
        $recepcionRegular[0]     = Encuesta::where('recepcion_atencion', 'REGULAR')->count();
        $recepcionRegular[1]     = Encuesta::where('recepcion_tiempo_espera', 'REGULAR')->count();
        $recepcionMala[0]        = Encuesta::where('recepcion_atencion', 'MALA')->count();
        $recepcionMala[1]        = Encuesta::where('recepcion_tiempo_espera', 'MALA')->count();                       
        
        $series = array([
                'name' => 'EXCELENTE',
                'data' => $recepcionExcelente
            ], [
                'name' => 'BUENA',
                'data' => $recepcionBuena
            ], [
                'name' => 'REGULAR',
                'data' => $recepcionRegular
            ], [
                'name' => 'MALA',
                'data' => $recepcionMala
            ]
        );
        
        return response()->json($series);
    }

    public function getEstadisticaDocumentos()
    {
        $documentos   = Encuesta::select('tramite_realizado', \DB::raw('count(*) as total'))
                        ->groupBy('tramite_realizado')
                        ->get();

        $series['name'] = 'Elaborados';
        $series['data'] = [];
        $data = [];
        foreach ($documentos as $row) {
            array_push($series['data'], $row->total);
            //array_push($series['labels'], $row->tramite_realizado);            
        }
        array_push($data, $series);

        return response()->json($data);
    }

    public function getAtencionServidorPublico()
    {        
        $servidorExcelente[0]   = Encuesta::where('servidor_atencion', 'EXCELENTE')->count();
        $servidorExcelente[1]   = Encuesta::where('servidor_tiempo_atencion', 'EXCELENTE')->count();
        $servidorBuena[0]       = Encuesta::where('servidor_atencion', 'BUENA')->count();
        $servidorBuena[1]       = Encuesta::where('servidor_tiempo_atencion', 'BUENA')->count();
        $servidorRegular[0]     = Encuesta::where('servidor_atencion', 'REGULAR')->count();
        $servidorRegular[1]     = Encuesta::where('servidor_tiempo_atencion', 'REGULAR')->count();
        $servidorMala[0]        = Encuesta::where('servidor_atencion', 'MALA')->count();
        $servidorMala[1]        = Encuesta::where('servidor_tiempo_atencion', 'MALA')->count();                       
        
        $series = array([
                'name' => 'EXCELENTE',
                'data' => $servidorExcelente
            ], [
                'name' => 'BUENA',
                'data' => $servidorBuena
            ], [
                'name' => 'REGULAR',
                'data' => $servidorRegular
            ], [
                'name' => 'MALA',
                'data' => $servidorMala
            ]
        );
        
        return response()->json($series);
    }    
}
