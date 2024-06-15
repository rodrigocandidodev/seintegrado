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

        <link rel="shortcut icon" href="{{url('img/favicon.ico')}}" />
	</head>
	<style type="text/css">
		*{
            font-family: 'Quicksand', sans-serif;
        }
        body{
            background-color: #fff;
        }

        .color-light-gray{
            color:#ccc;
        }

        hr {
            width: 50%;
            margin-right:0 0 0 auto;
        }
        .margin-top-10{
            margin-top: 10px;
        }

        /*Settings Page*/
        .painel-grid{
            background-color: white;
            width: 100%;
        }

        .painel-box-header{
            text-align: center;
        }

	</style>
	<body>
		<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white">
            <img class="my-0 mr-md-auto font-weight-normal" src="{{ URL::asset('img/seintegrado-logo-small.png')}}" alt="">
        </div>

        


	                    <div class="col-md-12">
	                        <div class="row">
	                            <div class="col-md-12">
	                                <strong style="font-size: 25px;">{{$student_data->name}}</strong>
	                            </div>
	                        </div>
	                        <h5 class="text-center">Dados Pessoais</h5>
	                        <hr>
	                        <div class="row mt-0">
	                            <div class="col-md-12">
	                                <strong>Mãe: </strong>
	                                <span>{{$student_data->mother}}</span>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-md-12">
	                                <strong>Pai: </strong><span>{{$student_data->father}}</span>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-md-12">
	                                <strong>Responsável Legal: </strong>
	                                <span>{{$student_data->legal_responsable}}</span>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-md-4">
	                                <strong>CPF: </strong>
	                                <span>{{$student_data->cpf}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>SUS: </strong>
	                                <span>{{$student_data->sus_number}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>Data de Nascimento</strong>
	                                <span>{{$student_data->date_birth}}</span>
	                            </div>
	                        </div>
	                        <h5 class="text-center">Dados da Certidão de Nascimento</h5>
	                        <hr>
	                        <div class="row">
	                            <div class="col-md-4">
	                                <strong>Matrícula</strong>
	                                <span>{{$student_data->matricula_cn}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>Data de registro</strong>
	                                <span>{{$student_data->date_cn}}</span>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-md-4">
	                                <strong>Termo</strong>
	                                <span>{{$student_data->termo}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>Livro</strong>
	                                <span>{{$student_data->livro}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>Folha</strong>
	                                <span>{{$student_data->folha}}</span>
	                            </div>
	                        </div>
	                        <h5 class="text-center">Endereço</h5>
	                        <hr>
	                        <div class="row">
	                            <div class="col-md-4">
	                                <strong>Rua</strong>
	                                <span>{{$student_data->street}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>Quadra</strong>
	                                <span>{{$student_data->block}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>Lote</strong>
	                                <span>{{$student_data->land_lot}}</span>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-md-4">
	                                <strong>Bairro</strong>
	                                <span>{{$student_data->neighborhood}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>CEP</strong>
	                                <span>{{$student_data->zipcode}}</span>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-md-12">
	                                <strong>Complemento</strong>
	                                <span>{{$student_data->complement}}</span>
	                            </div>
	                        </div>
	                        <h5 class="text-center">Contato</h5>
	                        <hr>
	                        <div class="row">
	                            <div class="col-md-4">
	                                <strong>Telefone 1</strong>
	                                <span>{{$student_data->phone1}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>Responsável pelo telofone 1</strong>
	                                <span>{{$student_data->phone1_responsable}}</span>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-md-4">
	                                <strong>Telefone 2</strong>
	                                <span>{{$student_data->phone2}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>Responsável pelo telofone 2</strong>
	                                <span>{{$student_data->phone2_responsable}}</span>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-md-4">
	                                <strong>Telefone 3</strong>
	                                <span>{{$student_data->phone3}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>Responsável pelo telofone 3</strong>
	                                <span>{{$student_data->phone3_responsable}}</span>
	                            </div>
	                        </div>
	                        <h5 class="text-center">Matrícula</h5>
	                        <hr>
	                        <div class="row">
	                            <div class="col-md-4">
	                                <strong>Código</strong>
	                                <span>{{$student_enrollment_data->enrollment_code}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>Data da Matrícula</strong>
	                                <span>{{$student_enrollment_data->enrollment_date}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>Ano Letivo</strong>
	                                <span>{{$student_enrollment_data->enrollment_year}}</span>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-md-4">
	                                <strong>Turma</strong>
	                                <span>{{$student_enrollment_data->institution_class}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>Status</strong>
	                                <span>{{$student_enrollment_data->enrollment_status}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>Colaborador que fez a matrícula</strong>
	                                <span>{{$student_enrollment_collaborator->name}}</span>
	                            </div>
	                        </div>
	                        <h5 class="text-center">Requerente da Matrícula</h5>
	                        <hr>
	                        <div class="row">
	                            <div class="col-md-4">
	                                <strong>Requerente</strong>
	                                <span>{{$student_enrollment_data->name}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>CPF</strong>
	                                <span>{{$student_enrollment_data->cpf}}</span>
	                            </div>
	                            <div class="col-md-4">
	                                <strong>RG</strong>
	                                <span>{{$student_enrollment_data->rg . ' - ' . $student_enrollment_data->rg_emissor}}</span>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-md-4">
	                                <strong>Grau de Parentesco</strong>
	                                <span>{{$student_enrollment_data->degree_relatedness}}</span>
	                            </div>
	                        </div>
	                        
	                        <div class="row">
	                            <div class="col-md-4">
	                                <strong>Autorização para uso de imagem</strong>
	                                @if($student_data->auth_image_use=='on')
	                                    <span>Sim</span>
	                                @else
	                                    <span>Não</span>
	                                @endif
	                            </div>
	                        </div>
	                        <h5 class="text-center">Saúde do aluno</h5>
	                        <hr>
	                        <div class="row">
	                            <div class="col-md-6">
	                                <strong>Necessidades Especiais</strong>
	                                <span>{{$student_data->health_special_needs}}</span>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-md-6">
	                                <strong>Problemas de Saúde</strong>
	                                <span>{{$student_data->health_problem}}</span>
	                            </div>
	                        </div>
	                        <h5 class="text-center">Dados de Acesso do aluno</h5>
	                        <hr>
	                        <div class="row">
	                            <div class="col-md-12">
	                                <strong>E-mail</strong>
	                                <span>{{$student_data->email}}</span>
	                            </div>
	                        </div>
	                    </div>




	</body>
