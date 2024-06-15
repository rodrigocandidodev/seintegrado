@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class=" col-md-12">
                <h3 class="text-center">Selecione o aluno</h3>
                <br>
                <label for="searchalunorematricular">Nome do aluno do ano letivo de </label><strong id="previous_year"> {{$previous_year}}</strong><br>
                <div class="form-search">
                    <input type="text" name="name_search_rematricular" id="searchalunorematricular" placeholder="Nome do aluno" required>
                    <div class="resultadorematricular">

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop