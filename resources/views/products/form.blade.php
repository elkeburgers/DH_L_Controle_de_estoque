<!-- para informar o arquivo que vamos usar o template: -->
@extends('layouts.app')

<!-- section abaixo eh uma funcao do laravel para incluir a pagina abaixo dentro do template no campo yeld -->
@section('content')

    <section class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Nome do Produto</label>
                <input class="form-control" type="text" name="nameProduct" id="nameProduct">
            </div>
            <div class="form-group">
                <label for="">Descrição</label>
                <input class="form-control" type="text" name="nameProduct" id="nameProduct">
            </div>
            <div class="form-group">
                <label for="">Quantidade</label>
                <input class="form-control" type="integer" name="nameProduct" id="nameProduct">
            </div>
            <div class="form-group">
                <label for="">Preço</label>
                <input class="form-control" type="float" name="nameProduct" id="nameProduct">
            </div>
        
        </form>        
    
    </section>


@endsection