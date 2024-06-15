<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} | {{$title}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <!-- Stylesheets-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css')}}">
        <link rel="shortcut icon" href="{{url('img/favicon.ico')}}" />
        <!--Icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
    <style type="text/css">
        *{
            font-family: 'Quicksand', sans-serif;
        }
        body{
            background-color: #fff;
            background-image: url(../img/header-background-2.png);
            background-repeat: no-repeat;
            background-size: contain;
            background-position: top ;
        }
        a:hover {
            text-decoration: none;
            color: gray;
        }
        form{
            margin-bottom: 10px;
        }
        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            padding-top: 100px;
            margin: auto;
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
        .rounded-borders-10{
            border-radius: 10px;
        }
        .outline-borders{
            background-color: transparent;
            background-image: none;
            border-color: #f69f8a;
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
        /*Dashboard config*/
        .dashboard-values{
            margin-left: 10px;
            text-align: center;
        }
        .dashboard-values span{
            font-size: 30px;
        }
        hr {
            width: 50%;
            /*text-align: center; /* to IE */
            margin-right:0 0 0 auto; /* to standard browsers */
        }
        .margin-top-10{
            margin-top: 10px;
        }
        .menu-lista{
            box-shadow: 2px 2px 20px rgba(108, 117, 125, 0.2);
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .menu-lista:hover{
            box-shadow: 2px 2px 20px rgba(246, 159, 138, 0.41);
        }

        /*General Modal config*/
        .modal-content{
            background-color: #fff;
            box-shadow: 1px 1px 20px 0px #00000026;
            border-radius: 10px;
        }
        .modal-content .modal-header, .modal-body{
            border: none;
        }
        .modal-menu-lista{
            box-shadow: 2px 2px 20px rgba(108, 117, 125, 0.2);
            margin-top: 10px;
            display: inline-flex;
        }
        .modal-menu-lista:hover{
            box-shadow: 2px 2px 20px rgba(246, 159, 138, 0.41);
        }
        /*Settings Page*/
        .painel-grid{
            background-color: white;
            width: 100%;
            /*height: 500px;*/
            box-shadow: 2px 2px 20px rgba(108, 117, 125, 0.2);
        }
        .painel-box{
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 15px;
        }
        .painel-box-header{
            text-align: center;
        }
        .painel-box-body li{
            list-style: none;
        }
        .painel-list {
            width: 100%;
        }
        .painel-list-item{
            margin-bottom: 5px;
            box-shadow: 2px 2px 20px rgba(108, 117, 125, 0.2);
            border: none;
            border-bottom-right-radius: .25rem;
            border-bottom-left-radius: .25rem;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
            padding-top: 1px;
            padding-bottom: 1px;
            background-color: #fff;
            list-style: none;
        }
        .painel-list a{
            color: gray;
        }
        .painel-list-item:hover{
            box-shadow: 2px 2px 20px rgba(246, 159, 138, 0.41);
            font-weight: bolder;
        }
        .painel-list-cel{
            width: 100%;
            list-style: none;
            display: -webkit-inline-box;
        }
        .painel-list-cel-item{
            margin: 5px;
            width: 20%;
            text-align: center;
            border: none;
        }
        .painel-list-item-index{
            padding-top: 2em;
        }
        .painel-list-name-cel{
            width: 30%;
            text-align: left;
            border: none;
        }
        .right-side-menu{
            background-color: #fff;
        }
        .bg-orange{
            background-color: #f69f8a;
        }
        .text-white{
            color: #fff;
        }
        .display-flex{
            display: flex;
        }


    </style>
    <body>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white">
            <img class="my-0 mr-md-auto font-weight-normal" src="{{ URL::asset('img/seintegrado-logo-full.png')}}" alt="" width="200" height="55">
        </div>
        <section class="content">
            @yield('conteudo')
        </section>
        <footer>
            <div class="container">
                <div class="row">
                    <p class="col-sm-12 text-center color-light-gray tm-font-light tm-color-white p-4 tm-margin-b-0">
                    SEINTEGRADO - Sistema Escolar Integrado <br>Rodrigo Cândido da Silva</p>  
                </div>
            </div>                
        </footer>
        <!-- jquery -->
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="{{url('js/app.js')}}"></script>
    </body>
</html> 