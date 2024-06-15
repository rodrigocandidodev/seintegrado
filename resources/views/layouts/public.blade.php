<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name')}} | {{$title}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <!-- Stylesheets-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css')}}">
        <link rel="shortcut icon" href="{{url('img/favicon.ico')}}" />
	</head>
    <style type="text/css">
        *{
            font-family: 'Quicksand', sans-serif;
        }
        body{
            background-image: url(../img/header-background.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top center;

        }
        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            padding-top: 100px;
            box-shadow: 2px 2px 20px rgba(108, 117, 125, 0.2);
            margin-left: auto;
            margin-right: auto;
            margin-top: 28px;
            background: white;
            border-radius: 10px;
        }

        .button-orange{
            background-color: #f69f8a;
            color: #fff;
        }
        .button-hover:hover{
            border-color: #f69f8a;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(246, 159, 138, 0.41);
        }
        .rounded-borders{
            border-radius: 20px;
        }
        .color-light-gray{
            color:#ccc;
        }
        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #f69f8a;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(246, 159, 138, 0.41);
        }
        /*Change text*/
        .text-entrar {
            height: 40px;
            font-size: 25px;
            line-height: 40px;
            position: relative;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            margin: auto;
            overflow: hidden;
        }
        ul {
            list-style: none;
            text-align: center;
            padding-left: 10px;
            animation: change-texto 10s infinite;
        }
        @keyframes change-texto {
            
            0%{ margin-top: 0;}
            20%{ margin-top: 0;}
            
            25% {margin-top: -40px;}
            50% {margin-top: -40px;}
            
            55% {margin-top: -80px;}
            80% {margin-top: -80px;}
            
            85% {margin-top: -40px;}
            95% {margin-top: -40px;}
            
            100% {margin-top: 0;}
        }
        @media only screen and (max-width: 320px){
            .form-signin{
                margin-top:0px;
            }
        }
        @media only screen and (max-width: 500px){
            .form-signin{
                box-shadow: none;
            }
        }
        @media only screen and (max-width: 768px){
            .form-signin{
                margin-top: 100px;
            }
        }
        @media only screen and (min-height: 1366px){
            .form-signin{
                transform: translateY(50%);
            }
            footer{
                margin-top: 20px;
            }
        }
        @media only screen and (min-width: 2048px){
            .form-signin{
                width: 100%;
                max-width: 400px;
                padding: 20px;
                padding-top: 200px;
                box-shadow: 2px 2px 20px rgba(108, 117, 125, 0.2);
                margin-left: auto;
                margin-right: auto;
                margin-top:150px;
            }
        }
        
        
        </style>
    <body>
        <section class="content">
            @yield('conteudo')
        </section>
        <footer class="tm-bg-white">
            <div class="container">
                <div class="row">
                    <p class="col-sm-12 text-center color-light-gray tm-font-light tm-color-white p-4 tm-margin-b-0">
                    SEINTEGRADO - Sistema Escolar Integrado <br>Rodrigo Cândido da Silva</p>  
                </div>
            </div>                
        </footer>
        <script src="{{url('js/app.js')}}"></script>
    </body>
</html> 