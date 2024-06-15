<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{config('app.name')}}</title>

	<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/homepage.css')}}">
    <link rel="shortcut icon" href="{{url('img/favicon.ico')}}" />
</head>
<style type="text/css">
	*{
        font-family: 'Quicksand', sans-serif;
    }
	.button-orange{
        background-color: #f69f8a;
        color: #fff;
    }
    .button-hover:hover{
        border-color: #fff;
        outline: 0;
        background-color: #f69f8a
    }
    .rounded-borders{
        border-radius: 20px;
    }
    .outline-borders{
        background-color: transparent;
        background-image: none;
        border-color: #f69f8a;
    }
    .color-light{
        color:#fff;
    }
    .menu-lista{
        box-shadow: 2px 2px 20px rgba(108, 117, 125, 0.2);
        margin-left: auto;
        margin-right: auto;
        margin-top: 10px;
    }
    .menu-lista:hover{
        box-shadow: 2px 2px 20px rgba(246, 159, 138, 0.5);
    }
    .margin-top-10{
        margin-top: 10px;
    }
    .login-options:hover{
        background: linear-gradient(87deg,#f69f8a 0,#dc807d 100%)!important;
        webkit-transform: translateY(-7px) !important;
        -ms-transform: translateY(-7px) !important;
        transform: translateY(-7px) !important;
        -webkit-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }
</style>
<body>
	<header>
		<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3">
		    <img class="my-0 mr-md-auto font-weight-normal " src="{{ URL::asset('img/seintegrado-logo.png')}}" alt="Seintegrado" width="100" height="76">
		    <nav class="my-2 my-md-0 mr-md-3">
		        <a class="p-2 color-light" href="#">Sobre</a>
		        <a class="p-2 color-light" href="#">Contato</a>
		    </nav>
		</div>
		<div class="hgroup">
			<h3>Bem vindo(a) ao</h3>
			<h2>SEINTEGRADO</h2>
			<h4>O sistema de gerenciamento para sua escola</h4>
		</div>
		
	</header>

	<footer>
        <div class="container">
            <div class="row">
                <div class="menu-lista login-options col-md-3 text-center bg-white rounded-borders">
	                <a class="text-muted" href="{{route('student.login')}}">
	                    <h3 class="margin-top-10">Aluno</h3>
	                    <p>Ambiente Virtual do aluno</p>
	                </a>
	            </div>
	            <div class="menu-lista login-options col-md-3 text-center bg-white rounded-borders">
	                <a class="text-muted" href="{{route('teacher.login')}}">
	                    <h3 class="margin-top-10">Professores</h3>
	                    <p>Ambiente complementar de trabalho do docente</p>
	                </a>
	            </div>
	            <div class="menu-lista login-options col-md-3 text-center bg-white rounded-borders">
	                <a class="text-muted" href="{{route('admin.login')}}">
	                    <h3 class="margin-top-10">Administradores</h3>
	                    <p>Ambiente de gestão de dados</p>
	                </a>
	            </div>
	        </div>
	        <br>
            <div class="row">
            	<p class="col-sm-12 text-center color-light-gray tm-font-light tm-color-white p-1 tm-margin-b-0">Copyright &copy; SEINTEGRADO - Sistema Escolar Integrado <br>Rodrigo Cândido da Silva</p> 
            </div>
        </div>                
    </footer>
    <script src="{{url('js/app.js')}}"></script>
</body>
</html>