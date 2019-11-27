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

        // teste para  validacao de imagem. Precisa ser antes do return:
        // se der erro, trocar imgProfile por img, aqui e no register.blade.
        // dd($data['imgProfile']->getClientOriginalName());
        // teste para o tamanho do arquivo:
        // dd($data['imgProfile']->getClientSize());

        // incluir para carga de arquivo, apos  validacoes acima:
        $nomeArquivo = $data['imgProfile']->getClientOriginalName();
        $dataAtual = date('y-m-d');
        $nomeArquivo = $dataAtual.$nomeArquivo;
        // acrescenta o caminho abaixopara as imagens serem carregadas para a  pasta recem criada em storage/app/public/profile, e concatena com a variavel nomeArquivo criada acima.
        // link de acesso  para o usuario ter acesso:
        $caminhoImg = "storage/profile/$nomeArquivo";
        // agora dizemos onde o laravel deve salvar o arquivo (o caminho que o usuario vai ver):
        // salvo a iamgem dentro do storage
        $resultado = $data['imgProfile']->storeAs('public/profile', $nomeArquivo);


        // passo 1 - precisamos alterar o padrão do laravel incluindo as informacoes que definimos para a criacao de usuario no nosso BD:
            // estah tudo dentro da variavel data, com varios inputs: name, email e password
            //hash: classe que criptografa a senha
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // incluimos:
            // caminhoImg conforme criado no storage acima, para ele saber onde salvar a imagem que serah carregada:
            'img_profile' => $caminhoImg,
            // para o php zero eh falso e um eh true, por isso ativo usamos um:
            'active' => 1
        ]);
    }
}
