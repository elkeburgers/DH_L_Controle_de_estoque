<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //apos criado o controller pelo artisan, criada a funcao a partir daqui:
    public function create(Request $request){
        // metodo acima 'create' fica responsavel por cadastrar um produto

        // metodo abaixo sujo, substituido pelo proximo:
        // if($request->isMethod('GET')){
        //     return view('formulario');
        // }else{
        //     // faco o cadastro do produto
        // }
    }

    //abaixo por questoes didaticas usamos 'viewForm', mas eh comum encontrarmos no mercado 'index'
    // padrao uma 'index' trazer uma view
    // request eh oara receber as informacoes da view
    public function viewForm(Request $request){ 
        return view('products.form');
        // view eh global, pode usar sempre. O laravel nao deixa utilizarmos codigo para importarmos, porque teria que passar por varias camadas dele, e nao poderiamos mais usar varios padroes dele.
        // o ponto substitui a barra em 'products.form', modelo laravel, sendo a pasta 'products' e o arquivo 'form'
    }
}
