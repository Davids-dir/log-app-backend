<?php

namespace App\Http\Controllers;

use App\Models\Log;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    //Función para registrar la hora de entrada de un empelado
    public function start_work($id)
    {
        // Obtenemos el horario actual a la hora de realizar la operación
        $timeNow = Carbon::now(new DateTimeZone('Europe/Madrid'));
        
        $work_query = DB::table('logs')->insert(['start_time' => $timeNow, 'user_id' => $id]);

        if (!$work_query) {
            return response()->json('Error en la operacion, intentalo de nuevo');
        } else {
            return response()->json('Has iniciado la jornada correctamente');
        }
    }

    public function end_work($id)
    {
        // Obtenemos el horario actual a la hora de realizar la operación
        $timeNow = Carbon::now(new DateTimeZone('Europe/Madrid'));

        $work_query = DB::table('logs')->where('user_id', $id)->update(['end_time' => $timeNow]);

        if (!$work_query) {
            return response()->json('Error en la operacion, intentalo de nuevo');
        } else {
            return response()->json('Has finalizado la jornada correctamente');
        }
    }
}