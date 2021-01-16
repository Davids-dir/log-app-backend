<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    //Función para registrar la hora de entrada de un empelado
    public function start_work(Request $request, $id)
    {

        $input = $request->only('ip');

        // Obtenemos el horario actual a la hora de realizar la operación
        $timeNow = Carbon::now(new DateTimeZone('Europe/Madrid'));

        // Query hacia la base de datos
        $work_query = DB::table('logs')->insert([
            'start_time' => $timeNow, 
            'ip' => $input['ip'],
             'user_id' => $id
        ]);

        if (!$work_query) {
            return response()->json('Error en la operacion, intentalo de nuevo');
        } else {
            return response()->json(['message' => 'Has iniciado la jornada correctamente', 'hora' => $timeNow], 200);
        }
    }

    public function end_work($id)
    {
        // Obtenemos el horario actual a la hora de realizar la operación
        $timeNow = Carbon::now(new DateTimeZone('Europe/Madrid'));

        $work_query = DB::table('logs')->where('user_id', $id)->update(['end_time' => $timeNow]);

        if (!$work_query) {
            return response()->json('Error en la operación, intentalo de nuevo');
        } else {
            return response()->json(['message' => 'Has finalizado la jornada correctamente', 'hora' => $timeNow], 200);
        }
    }

    public function start_pause($id)
    {
        // Obtenemos el horario actual a la hora de realizar la operación
        $timeNow = Carbon::now(new DateTimeZone('Europe/Madrid'));

        $pause_start_query = DB::table('logs')->where('user_id', $id)->update(['pause_start' => $timeNow]);

        if (!$pause_start_query) {
            return response()->json( 'Error en la operación, intentalo de nuevo');
        } else {
            return response()->json(['message' => 'Has pausado la sesión de trabajo', 'hora' => $timeNow], 200);
        }
    }

    public function end_pause($id)
    {
        // Obtenemos el horario actual a la hora de realizar la operación
        $timeNow = Carbon::now(new DateTimeZone('Europe/Madrid'));

        $pause_end_query = DB::table('logs')->where('user_id', $id)->update(['pause_end' => $timeNow]);

        if (!$pause_end_query) {
            return response()->json('Error en la operación, intentalo de nuevo');
        } else {
            return response()->json(['message' => 'Has reanudado la sesión de trabajo', 'hora' => $timeNow], 200);
        }
    }

    public function show_all()
    {
        $all_logs = Log::all();

        return $all_logs;
    }

    public function show_one(Request $request)
    {
        $input = $request->input('email');

        $logs = User::where('email', $input)->with('logs')->first();

        if(!$logs){
            return response()->json('El email es incorrecto');
        }
        else {
            return response()->json($logs);
        }
    }
}
