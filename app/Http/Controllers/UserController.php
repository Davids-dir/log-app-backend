<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Metodo POST
    // Función para que un usuario con el rol de Administrador pueda dar de alta nuevos empleados
    public function register (Request $request) {
        
        $input = $request -> all ( );
        $input ['password']  = bcrypt ($input ['password']);

        // Defino los campos obligatorios para realizar el POST
        $rules = [
            'name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required | min: 4',
            'department' => 'required',
            'contract' => 'required',
        ];

        $messages = [
            'name.required' => 'El campo Nombre no puede estar vacío',
            'last_name.required' => 'El campo Apellidos no puede estar vacío',
            'email.required' => 'El campo Correo electrónico no puede estar vacio',
            'password' => 'El campo Contraseña no puede estar vacío',
            'department' => 'Debes de escoger un Departamento',
            'contract' => 'Debes de escoger un tipo de contrato',
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

    // Función para que un usuario haga Login
    public function login (Request $request) {
        
        $credentials = $request -> only ('email', 'password');

        if (Auth::attempt ($credentials )) {
            
            // Devuelvo el usuario a traves del Auth
            $user = Auth::user ( );

            // Asigno la creacion del token al usuario
            $token = $user -> createToken ('Token') -> accessToken;

            // Establezco la respuesta hacia el Frontend
            $data = [];
            $data ['user'] = $user;
            $data ['token'] = $token;

            return response ( ) -> json ($data, 200);
        }
        else {
            return response ( ) -> json ([ 'error' => 'Se ha producido un fallo en el proceso, revisa los datos' ], 400);
        }
    }

    public function logout (Request $request) {

        $token = $request -> user() -> token();
        $token -> revoke();

        return response () -> json ('Se ha cerrado la sesión de manera correcta', 200);
    }
};
