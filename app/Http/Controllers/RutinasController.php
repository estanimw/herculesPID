<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Rutina;
use App\Models\Ejercicio;

class RutinasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function rutinas()
    {
        $rutinas = Rutina::all();
        $ejercicios = Ejercicio::all();
        return view('rutinas.listRutinas', compact('rutinas','ejercicios'));
    }

    public function crearRutina(Request $request)
    {
        DB::beginTransaction();
        $nombre = $request->nombre;

        $ejerciciosRutina = new \stdClass();
        for ($i=1; $i<8 ; $i++) {
            $param_ejercicios = 'ejercicios_dia'.$i;
            $param_repeticiones = 'repeticiones_dia'.$i;

            $ejercicios_dia = $request->$param_ejercicios;
            $repeticiones_dia = $request->$param_repeticiones;

            $cantEjercicios = count($ejercicios_dia);

            $seriesDelDia = array();
            for ($j=0; $j < $cantEjercicios; $j++) {
                $ejercicio = $ejercicios_dia[$j];
                $serie = $repeticiones_dia[$j];

                if (!$ejercicio==null && !$serie==null) {
                    array_push($seriesDelDia, array('ejercicio_id' => $ejercicios_dia[$j], 'repeticiones' => $repeticiones_dia[$j]));
                }
            }
            $ejerciciosRutina->$i = $seriesDelDia;
        }

        try {
            Rutina::create([ 'nombre' => $request->nombre, 'ejercicios' => json_encode($ejerciciosRutina) ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('rutinas');
    }

    public function detalleRutina($id)
    {
        DB::beginTransaction();
        $rutina_id = $id;

        try {
            $rutina = Rutina::where('id',$rutina_id)->firstOrFail();
            $ejercicios = Ejercicio::all();
        } catch (Exception $e) {
            return redirect()->back();
        }

        return view('rutinas.detalleRutina', compact('rutina','ejercicios'));
    }

    public function editarRutina(Request $request, $id)
    {
        DB::beginTransaction();

        $nombre = $request->nombre;

        $ejerciciosRutina = new \stdClass();
        for ($i=1; $i<8 ; $i++) {
            $param_ejercicios = 'ejercicios_dia'.$i;
            $param_repeticiones = 'repeticiones_dia'.$i;

            $ejercicios_dia = $request->$param_ejercicios;
            $repeticiones_dia = $request->$param_repeticiones;

            $ejercicios_dia = $ejercicios_dia==null ? [] : $ejercicios_dia;

            $cantEjercicios = count($ejercicios_dia);

            $seriesDelDia = array();
            for ($j=0; $j < $cantEjercicios; $j++) {
                $ejercicio = $ejercicios_dia[$j];
                $serie = $repeticiones_dia[$j];

                if (!$ejercicio==null && !$serie==null) {
                    array_push($seriesDelDia, array('ejercicio_id' => $ejercicios_dia[$j], 'repeticiones' => $repeticiones_dia[$j]));
                }
            }
            $ejerciciosRutina->$i = $seriesDelDia;
        }

        try {
            Rutina::where('id',$id)->update([ 'nombre'=>$nombre, 'ejercicios' => json_encode($ejerciciosRutina) ]);
            $rutina = Rutina::where('id',$id)->firstOrFail();
            $ejercicios = Ejercicio::all();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }

        return view('rutinas.detalleRutina', compact('rutina','ejercicios'));
    }
}