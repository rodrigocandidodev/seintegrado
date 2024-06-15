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
        <link href="https://fonts.googleapis.com/css?family=Roboto|Spartan:700&display=swap" rel="stylesheet">
        <!-- Stylesheets-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css')}}">
        <link rel="shortcut icon" href="{{url('img/favicon.ico')}}" />
        <!--Icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
    <style type="text/css">
        *{
            font-family: 'Quicksand','Century Gothic', sans-serif;
        }
        body{
            /*background-color: #fff;*/
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
            outline: none;
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
        .margin-top-20{
            margin-top: 20px;
        }
        .margin-top-30{
            margin-top: 30px;
        }
        .margin-top-50{
            margin-top: 50px;
        }
        .margin-top-100{
            margin-top: 100px;
        }
        .padding-bottom-10{
            padding-bottom: 10px;
        }
        .menu-lista{
            box-shadow: 2px 2px 20px rgba(108, 117, 125, 0.2);
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .menu-lista:hover{
            box-shadow: 2px 2px 20px rgba(246, 159, 138, 0.55)!important;
            webkit-transform: translateY(-7px) !important;
            -ms-transform: translateY(-7px) !important;
            transform: translateY(-7px) !important;
            -webkit-transition: all 0.2s ease;
            -o-transition: all 0.2s ease;
            transition: all 0.2s ease;
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
        .painel-list, .under-menu-box {
            width: 100%;
        }
        .painel-list-item, .under-menu-box{
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
            webkit-transform: translateY(-7px) !important;
            -ms-transform: translateY(-7px) !important;
            transform: translateY(-7px) !important;
            -webkit-transition: all 0.2s ease;
            -o-transition: all 0.2s ease;
            transition: all 0.2s ease;
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
        .painel-list-name-cel-100{
            text-align: left;
            border: none;
        }
        .right-side-menu{
            background-color: #fff;
            /*border-left: 1px solid rgba(246, 159, 138, 0.41);*/
        }

        .bg-orange{
            background: linear-gradient(87deg,#f69f8a 0,#dc807d 100%)!important;
        }
        .bg-seintegrado-orange{
            background: linear-gradient(87deg,#A63A19 0,#F55725 100%)!important;
        }
        .bg-seintegrado-gray{
            background: linear-gradient(87deg,#2d2d2b 0,#191713 100%)!important;
        }
        .bg-seintegrado-blue{
            background: linear-gradient(87deg,#2F2DA6 0,#4441F2 100%)!important;
        }
        .bg-seintegrado-purple{
            background: linear-gradient(87deg,#392163 0,#7744CC 100%)!important;
        }
        .bg-seintegrado-pink{
            background: linear-gradient(87deg,#A62339 0,#F53455 100%)!important;
        }
        .bg-seintegrado-yellow{
            background: linear-gradient(87deg,#F0C022 0,#E3B520 100%)!important;
        }
        .text-white{
            color: #fff;
        }
        .text-center{
            text-align: center;
        }
        .display-flex{
            display: flex;
        }
        .float-left{
            float: left;
        }
        .form-search{
            background: #fff;
            display: block;
            border-radius: 24px;
            z-index: 3;
            margin: 0 auto;
            border-color: rgba(223,225,229,0);
            box-shadow: 0 1px 6px 0 rgba(32,33,36,0.28);
        }
        .form-search:hover{
            height: unset;
        }
        .form-search input{
            border: none;
            width: 90%;
            margin: 2px auto;
            display: block;
            height: calc(2.19rem + 2px);
            padding: .375rem .75rem;
            font-size: .9rem;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
        }
        .form-search input:focus{
            outline: none;
        }
        .form-search li{
            list-style: none;
        }

        .searchbar-item{
            font-weight: lighter;
            width:90%;
            border:none;
            color: gray;
            padding-left: 50px;
            transition: all 0.3s;

        }
        .searchbar-item:hover{
            color: #f69f8a;
            font-weight: bolder;
        }
        .isearchbar-item a{
            text-decoration: none;
        }
        .inline-list-squares{
            margin-top: .3em;
            margin-right: .3em;
            border-radius: 5px;
            box-shadow: 0 1px 6px 0 rgba(32,33,36,0.28);
            width: 60px;
            height: 60px;
        }
        .inline-list-rectangles{
            margin-top: .3em;
            margin-right: .3em;
            margin-left: 0.54em;
            border-radius: 5px;
            box-shadow: 0 1px 6px 0 rgba(32,33,36,0.28);
            width: 120px;
        }
        .inline-list-rectangles-250{
            margin-top: .3em;
            margin-right: .3em;
            margin-left: 0.54em;
            border-radius: 5px;
            box-shadow: 0 1px 6px 0 rgba(32,33,36,0.28);
            width: 250px;
        }

        .inline-list-rectangles:hover{
            background: linear-gradient(87deg,#f69f8a 0,#dc807d 77%)!important;
        }
        .inline-list-rectangles-250:hover{
            background: linear-gradient(87deg,#f69f8a 0,#dc807d 77%)!important;
        }
        .inline-list-rectangles span {
            font-size: 13px;
        }
        .profile-inline-list-rectangles{
            margin-top: .3em;
            margin-right: .3em;
            margin-left: 0.54em;
            border-radius: 5px;
            box-shadow: 0 1px 6px 0 rgba(32,33,36,0.28);
            width: 120px;
        }
        .profile-inline-list-rectangles p {
            font-size: 16px;
        }
        .box-shadow-set{
            box-shadow: 0 1px 6px 0 rgba(32,33,36,0.28);
        }
        .profile-banner{
            width: 2560px;
            height: 250px;
            background: linear-gradient(87deg,#f69f8a 0,#dc807d 77%)!important;
        }


        .profile-banner h1 strong{
            font-family: 'Spartan', sans-serif;
        }

        .profile-banner button:hover{
            box-shadow: 0 1px 6px 0 rgba(32,33,36,0.28);
        }
        .profile-banner-statistic{
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
            margin-bottom: 10px;
            background: linear-gradient(87deg,#f69f8a 0,#dc807d 100%)!important;
        }
        .profile-banner-statistic h1{
            color: #ffffff;
        }
        .profile-banner-statistic:hover{
            background: linear-gradient(87deg,#fd977e 0,#dc807d 80%)!important;
        }
        .profile-contents span{
            font-size: 20px;
        }
        .categories-box{
            padding-top: 10px;
        }
        .categories {
            margin-top: 15px;
        }
        .profile-actions{
            padding-top: 5px;
        }

        .menu-down-upon-content:hover{
            font-weight: 900;
            border-bottom: 1px #ccc solid;
        }

    </style>
    <body onload="closeNotification()">
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <img class="my-0 mr-md-auto font-weight-normal" src="{{ URL::asset('img/seintegrado-logo-full.png')}}" alt="" width="200" height="55">
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 color-light-gray text-muted" >{{ $admin_type_data }}</a>

                <a class="p-2 bg-orange text-white rounded-borders" data-toggle="modal" data-target="#anoLetivoModal" href="#" id="current_school_year" >{{ $current_school_year }}</a>

                <a class="p-2 color-light-gray text-muted" >{{ $online_collaborator_name }}</a>
                @if($guard=='admins')
                    <a class="p-2 color-light-gray" href="{{ route('admin.show.dashboard', $current_school_year)}}">Dashboard</a>
                    <a class="p-2 color-light-gray" href="{{route('admin.show.collaborator.data',[$current_school_year,$online_collaborator_id])}}">Perfil</a>
                    <!--<a class="p-2 color-light-gray" href="#"><i class="fa fa-bell"></i> Mensagens</a>-->
                @endif
                @if($guard=='core-admins')
                    <a class="p-2 color-light-gray" href="{!! url('/core-admin') !!}">Home</a>
                    <a class="p-2 color-light-gray" href="{{route('core-admin.show.collaborator.data',[$online_collaborator_id])}}">Perfil</a>
                    <!--<a class="p-2 color-light-gray" href="#"><i class="fa fa-bell"></i> Mensagens</a>-->
                @endif
                @if($guard=='students')
                    <a class="p-2 color-light-gray" href="{!! url('/student') !!}">Home</a>
                    <a class="p-2 color-light-gray" href="{{route('student.show.student.data')}}">Perfil</a>
                    <!--<a class="p-2 color-light-gray" href="#"><i class="fa fa-bell"></i> Mensagens</a>-->
                @endif
                @if($guard=='teachers')
                    <a class="p-2 color-light-gray" href="{{ route('teacher.show.dashboard', $current_school_year)}}">Dashboard</a>
                    <a class="p-2 color-light-gray" href="{{route('teacher.show.collaborator.data',[$current_school_year,$online_collaborator_id])}}">Perfil</a>
                    <!--<a class="p-2 color-light-gray" href="#"><i class="fa fa-bell"></i> Mensagens</a>-->
                @endif
                @if($guard=!'teachers' AND $guard=!'students' AND $guard=!'core-admins' AND $guard=!'admins')
                    <a class="p-2 color-light-gray" href="{!! url('/home') !!}">Home</a>
                    <a class="p-2 color-light-gray" href="#">Perfil</a>
                    <!--<a class="p-2 color-light-gray" href="#"><i class="fa fa-bell"></i> Mensagens</a>-->
                @endif
            </nav>
            <a class="btn button-hover outline-borders rounded-borders text-dark" href="#"  data-toggle="modal" data-target="#logoutModal">Sair</a>
        </div>
        <!-- Logout Modal -->
        <div class="modal fade " id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="logoutModalTitle">Sair</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <div class="form-row">
                        <p>Você deseja realmente sair?</p>
                    </div>
                <div class="modal-footer">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Não</button>
                        <button type="submit" class="btn button-orange rounded-borders">Sim</button>
                    </form> 
                </div> 
              </div>
            </div>
          </div>
        </div>
        <!-- FIM Logout Modal -->
         <!-- Ano Letivo Modal -->
        <div class="modal fade " id="anoLetivoModal" tabindex="-1" role="dialog" aria-labelledby="anoLetivoModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="anoLetivoModalTitle">Anos Letivos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($guard == 'admins')
                        <div class="row text-center">
                            <div class="col-md-12">
                                <a href="#" data-toggle="modal" data-target="#novoanoLetivoModal">Novo Ano Letivo</a>
                                <br>
                                <a href="#" data-toggle="modal" data-target="#selectanoLetivoModal">Editar Ano Letivo</a>
                            </div>
                        </div>
                        <hr>
                    @endif
                    
                    <div class="row">
                        @foreach($all_school_years as $year_data)
                            <a href="{{route('admin.show.dashboard',[$year_data->year])}}">
                                <div class="inline-list-rectangles text-center bg-white">
                                    <h5 class="p-2 text-dark" >{{$year_data->year}}</h5>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
          </div>
        </div>
        <!-- FIM Ano Letivo Modal -->
        <!-- selecionar Ano Letivo Modal -->
        <div class="modal fade " id="selectanoLetivoModal" tabindex="-1" role="dialog" aria-labelledby="selectanoLetivoModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectanoLetivoModalTitle">Ano Letivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <p>Selecione o ano letivo que deseja editar</p>
                        </div>
                    </div>

                    <hr>
                    <div class="row text-center">
                        <div class="col-md-12">
                            @foreach($all_school_years as $year_data)
                                <a href="#" data-toggle="modal" data-target="#editaranoLetivoModal{{$year_data->id}}">
                                    <div class="modal-menu-lista rounded-borders col-md-2 bg-white outline">
                                        <h5 class="p-2 text-dark" >{{$year_data->year}}</h5>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
              </div>
            </div>
          </div>
        </div>
        <!-- FIM selecionar Ano Letivo Modal -->
        <!-- editar Ano Letivo Modal -->
        @foreach($all_school_years as $year_data)
            <div class="modal fade " id="editaranoLetivoModal{{$year_data->id}}" tabindex="-1" role="dialog" aria-labelledby="editaranoLetivoModalTitle{{$year_data->id}}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editaranoLetivoModalTitle{{$year_data->id}}">Editar Ano Letivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{route('admin.update.school-year.submit',$current_school_year)}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Instituição</label>
                                <select class="custom-select form-control  rounded-borders" name="institution_id" readonly>
                                    <option value="{{$online_collaborator_institution_id}}">{{$online_institution_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Ano Letivo</label>
                                <input type="number" min="2000" name="year" class="form-control rounded-borders" value="{{$year_data->year}}" required>
                                <input type="hidden" name="id" value="{{$year_data->id}}">
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        @endforeach
        <!-- FIM editar Ano Letivo Modal -->
        @if($guard == 'admins')
            <!-- Novo Ano Letivo Modal -->
            <div class="modal fade " id="novoanoLetivoModal" tabindex="-1" role="dialog" aria-labelledby="novoanoLetivoModalTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="novoanoLetivoModalTitle">Novo Ano Letivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{route('admin.store.school-year.submit')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="institution_id">Instituição</label>
                                <select class="custom-select form-control  rounded-borders" name="institution_id" readonly>
                                    <option value="{{$online_collaborator_institution_id}}">{{$online_institution_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAnoLetivo">Ano Letivo</label>
                                <input type="number" min="2000" name="year" class="form-control rounded-borders" id="inputAnoLetivo" placeholder="Digite o ano letivo" required>
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- FIM Novo Ano Letivo Modal -->
        @endif

        <section class="content">
            @yield('conteudo')
        </section>
        <footer class="margin-top-50">
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
        <script>
            $(function(){
                $('#search').on('keyup',function(){
                    $value = $(this).val();
                    var year = $('#current_school_year').text();
                    var institution_id = "{{$online_collaborator_institution_id}}";

                    $.ajax ({
                        type: 'get',
                        url: "{{URL::to('admin/search/student')}}",
                        data: {'search':$value,'current_school_year':year, 'institution_id': institution_id},
                        success: function (data){
                            $('.resultado').html(data);
                        }
                    });
                });
            });

            $(function(){
                $('#search_collaborator').on('keyup',function(){
                    $value = $(this).val();
                    var year = $('#current_school_year').text();
                    var institution_id = "{{$online_collaborator_institution_id}}";

                    $.ajax ({
                        type: 'get',
                        url: "{{URL::to('admin/search/collaborator')}}",
                        data: {'search_collaborator':$value,'current_school_year': year, 'institution_id': institution_id},
                        success: function (data){
                            $('.resultado_collaborator').html(data);
                        }
                    });
                });
            });
        </script>
        <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>
        <script>
            function closeNotification(){
                setTimeout(function(){
                    document.getElementById('notification_tab').style.display = 'none';
                },5000);
            }
        </script>
    </body>
</html> 