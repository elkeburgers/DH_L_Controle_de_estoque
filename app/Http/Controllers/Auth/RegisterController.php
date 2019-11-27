<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// abaixo model 'user' importado depois que nos "criamos", na verdade, completamos.
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


     // passo 2 - abaixo (padrao) classe validator existe para restricoes no cadastro, validando ele ainda no formulario (validacao back-end):
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */


     // criacao do usuario padrao do laravel, carregando os dados no BD.
    protected function create(array $data)
    {
        // passo 1 - precisamos alterar o padrão do laravel incluindo as informacoes que definimos para a criacao de usuario no nosso BD:
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // incluimos:
            'img_profile' => 'img',
            // para o php zero eh falso e um eh true, por isso ativo usamos um:
            'active' => 1
        ]);
    }
}
