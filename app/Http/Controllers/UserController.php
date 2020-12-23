<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Metodo POST
    public function register ( Request $request) {
        
        $input = $request -> all ( );
        $input ['password']  = bcrypt ($input ['password']);

        // Defino los campos obligatorios para realizar el POST
        $rules = [
            'name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required | min: 4',
            'department' => 'required',
        ];

        $messages = [
            'name.required' => 'El campo Nombre no puede estar vacío',
            'last_name.required' => 'El campo Apellidos no puede estar vacío',
            'email.required' => 'El campo Correo electrónico no puede estar vacio',
            'password' => 'El campo Contraseña no puede estar vacío',
            'department' => 'Debes de escoger un Departamento',
        ];

        $validator = validator::make ($input, $rules, $messages);

        if ($validator -> fails ( )) {
            return response ( ) -> json ([$validator -> errors ( )], 400);
        }
        else {
            $user = User::create ($input);
            return $user;
        }

    }
}
