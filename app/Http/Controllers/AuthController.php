<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistroRequest;

class AuthController extends Controller
{
    //

   
    public function register(RegistroRequest $request)
    {
        //               OBTENER LOS DATOS YA VALIDADOS
        $data = $request->validated();
        /*
        validate() se utiliza para realizar la 
        validación y manejar automáticamente cualquier error, 
        mientras que .
        
        validated() se utiliza para acceder a los
         datos validados después de que la validación ha tenido 
         éxito. Ambos son útiles en diferentes momentos del flujo
          de trabajo de validación de formularios en Laravel.
        */ 

        //                     CREAR USUARIO
        $user= User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => bcrypt($data['password']),
        ]);

        //                 RETORNAR RESPUESTA
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user'  => $user
        ];
    }
    public function login(LoginRequest $request)
    {

        //return "Desde login";

        $data = $request->validated();

        //                                 REVISAR EL PASSWORD
        if(!Auth::attempt($data)){ //en caso de que no se pueda autenticar el usuario 
            /*
            attempt es un method de la clase de AUTH que sirve para autenticar al usuario 
            En este caso los campos ya estan validados 
            Utilizo validated() para obtener los datos ya validados y pasarselos a attempt

            $credentials = $request->only('email', 'password'); en el caso de que haya mas campos pero esta vez solo tenemos dos
            */

            return response([
                'errors' => ['El email o el password son incorrectos']
            ],422);
            /*
            por defecto el status que tiene es el 200 , debemos de cambiarlo a 422 para que pueda 
            capturarlo el catch y mostrar el mensaje de error
            */
        }
        //                        AUTENTICAR AL USUARIO
        $user = Auth::user();
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user'  => $user
        ];
        
    }
    public function logout(Request $request)
    {

       // return 'logout ......';
       //               REVORCAR ESE TOKEN
       $user = $request->user();
       $user->currentAccessToken()->delete();

       return [
        'user' => null
       ];
       
    }
}
