@extends('layouts/pages')

@section('conteudo')
    <!--STICKY-MENU-BAR-->
    <div class="nav-scroller py-1 mb-2">
        <h4 class="text-center">Planos</h4>
        <hr>   
    </div>
    <!--GRID-MENU-->
    <div class="container">
        <div class="row">
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders">
                <a class="text-muted" href="{{route('teacher.plans.group',['group_id' => '1'])}}">
                    <h1 class="margin-top-10">G1</h1>
                    <p>20/10/2019 - 15/11/2019</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders">
                <a class="text-muted" href="#">
                    <h1 class="margin-top-10">G2</h1>
                    <p>20/10/2019 - 15/11/2019</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders">
                <a class="text-muted" href="#">
                    <h1 class="margin-top-10">G3</h1>
                    <p>20/10/2019 - 15/11/2019</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders">
                <a class="text-muted" href="#">
                    <h1 class="margin-top-10">G4</h1>
                    <p>20/10/2019 - 15/11/2019</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders">
                <a class="text-muted" href="#">
                    <h1 class="margin-top-10">G5</h1>
                    <p>20/10/2019 - 15/11/2019</p>
                </a>
            </div>
           
        </div>
    </div>

@stop