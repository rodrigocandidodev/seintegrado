@extends('layouts/pages')

@section('conteudo')
<style type="text/css">
    .enrollment-forms{
        background: #fff;
        margin: auto;
        border-radius: 10px;
        box-shadow: 2px 2px 20px rgba(108, 117, 125, 0.2);
    }
    .enrollment-forms form {
        margin-top: 10px;
    }
</style>
<?php $teste = true; ?>
<div class="container">
    <div class="row">
        <div class="painel-list">
            <h3 class="text-center">Nova Matrícula</h3>
            @if(Session::has('success'))
                <div class="col-md-12">
                    <div class="col-md-4 m-auto mb-5 alert alert-success text-center rounded-borders" id="notification_tab">
                        {{ Session::get('success') }}
                    </div>
                </div>
                
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 enrollment-forms">
            @if(!(Session::has('maindata_success')))
                <form id="studentMaindata" action="{{route('admin.store.student.maindata1',$current_school_year)}}" method="POST">
                    @csrf
                    <strong>Dados Pessoais</strong>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control rounded-borders" id="name" name="name" placeholder="Nome Completo do aluno" autofocus required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>CPF (sem pontos e traços)</label>
                            <input type="text" class="form-control rounded-borders" name="cpf" placeholder="CPF" maxlength="11" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender_id">Gênero</label>
                            <select class="custom-select form-control  rounded-borders" name="gender_id" required>
                                <option selected>Selecione o gênero</option>
                                @foreach($genders as $gender)
                                    <option value="{{$gender->id}}">{{$gender->gender}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="color_id">Cor</label>
                            <select class="custom-select form-control  rounded-borders" name="color_id" required>
                                <option selected>Selecione a cor</option>
                                @foreach($colors as $color)
                                    <option value="{{$color->id}}">{{$color->color}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="date_birth">Data de Nascimento</label>
                            <input type="date" class="form-control rounded-borders" id="date_birth" name="date_birth" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="place_birth">Naturalidade</label>
                            <input type="text" class="form-control rounded-borders" id="place_birth" name="place_birth" placeholder="Local de Nascimento-UF" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="father">Pai</label>
                            <input type="text" class="form-control rounded-borders" id="father " name="father" placeholder="Nome Completo do pai" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mother">Mãe</label>
                            <input type="text" class="form-control rounded-borders" id="mother" name="mother" placeholder="Nome Completo da mãe" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="legal_responsable">Responsável Legal</label>
                            <input type="text" class="form-control rounded-borders" id="legal_responsable" name="legal_responsable" placeholder="Responsável Legal" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="legal_responsable">Autorizar Uso de Imagem</label>
                            <select class="custom-select form-control  rounded-borders" id="auth_image_use" name="auth_image_use" required>
                                <option selected value="on">Sim</option>
                                <option value="off">Não</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="health_special_needs">Necessidade Especial</label>
                            <input type="text" class="form-control rounded-borders" id="health_special_needs" name="health_special_needs" placeholder="Necessidade Especial" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="health_problem">Problema de Saúde</label>
                            <input type="text" class="form-control rounded-borders" id="health_problem" name="health_problem" placeholder="Problema de Saúde" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="sus_number">SUS</label>
                            <input type="text" class="form-control rounded-borders" id="sus_number" name="sus_number" placeholder="Número do cartão" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control rounded-borders" id="email_responsable" name="email" placeholder="E-mail válido">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="password">Senha de 8 dígitos</label>
                            <input type="password" class="form-control rounded-borders" id="password_responsable" name="password" placeholder="Senha de 8 dígitos">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="institution_class_id">Turma</label>
                            <select class="custom-select form-control  rounded-borders" name="institution_class_id">
                                @foreach($all_institution_classes as $classes)
                                    <option selected value="{{$classes->id}}">{{$classes->institution_class}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row d-flex flex-row-reverse">
                        <button type="submit" class="btn button-orange bg-orange rounded-borders">Continuar</button>
                        <a href="{{route('admin.show.dashboard',$current_school_year)}}">
                            <button type="button" class="btn btn-secondary rounded-borders">Cancelar</button>
                        </a>
                    </div>
                </form>
            @else
                @if(!(Session::has('birth_certificate_success')))
                    <form action="{{route('admin.store.student.birth-certificate.submit',$current_school_year)}}" method="POST">
                        <strong>Certidão de Nascimento</strong>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="student_id">Aluno</label>
                                <select class="custom-select form-control  rounded-borders" name="student_id" readonly>
                                    <option selected value="{{ Session::get('id') }}">{{ Session::get('student') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="matricula_cn">Matrícula da Certidão de Nascimento</label>
                                <input type="text" class="form-control rounded-borders" id="matricula_cn" name="matricula_cn" placeholder="Matrícula">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date_cn">Data de Registro</label>
                                <input type="date" class="form-control rounded-borders" id="date_cn" name="date_cn">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="termo">Termo (sem pontos e traços)</label>
                                <input type="text" class="form-control rounded-borders" id="termo" name="termo" placeholder="Número do Termo">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="livro">Livro</label>
                                <input type="text" class="form-control rounded-borders" id="livro" name="livro" placeholder="Livro">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="folha">Folha</label>
                                <input type="text" class="form-control rounded-borders" id="folha" name="folha" placeholder="Folha">
                            </div>
                        </div>
                        <div class="form-row d-flex flex-row-reverse">
                            <button type="submit" class="btn button-orange bg-orange rounded-borders">Continuar</button>
                            <a href="{{route('admin.show.dashboard',$current_school_year)}}">
                                <button type="button" class="btn btn-secondary rounded-borders">Cancelar</button>
                            </a>
                        </div>
                    </form>
                @else
                    @if(!(Session::has('address_success')))
                        <form action="{{route('admin.store.student.address1.submit',$current_school_year)}}" method="POST">
                            <strong>Endereço</strong>
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="student_id">Aluno</label>
                                    <select class="custom-select form-control  rounded-borders" name="student_id" readonly>
                                        <option selected value="{{ Session::get('id') }}">{{ Session::get('student') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="street">Rua</label>
                                    <input type="text" class="form-control rounded-borders" id="street" name="street" placeholder="Rua">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="block">Quadra</label>
                                    <input type="text" class="form-control rounded-borders" id="block" name="block" placeholder="Quadra">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="land_lot">Lote</label>
                                    <input type="text" class="form-control rounded-borders" id="land_lot" name="land_lot" placeholder="Lote">
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="neighborhood">Bairro</label>
                                    <input type="text" class="form-control rounded-borders" id="neighborhood" name="neighborhood" placeholder="Bairro">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="number">Número</label>
                                    <input type="text" class="form-control rounded-borders" id="number" name="number" placeholder="Número">
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label for="zipcode">CEP</label>
                                    <input type="text" class="form-control rounded-borders" id="zipcode" name="zipcode" placeholder="CEP" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="complement">Complemento</label>
                                    <input type="text" class="form-control rounded-borders" id="complement" name="complement">
                                </div>
                            </div>
                            <div class="form-row d-flex flex-row-reverse">
                                <button type="submit" class="btn button-orange bg-orange rounded-borders">Continuar</button>
                                <a href="{{route('admin.show.dashboard',$current_school_year)}}">
                                    <button type="button" class="btn btn-secondary rounded-borders">Cancelar</button>
                                </a>
                            </div>
                        </form>
                    @else
                        @if(!(Session::has('contact_success')))
                            <form action="{{route('admin.store.student.contact.submit',$current_school_year)}}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="student_id">Aluno</label>
                                        <select class="custom-select form-control  rounded-borders" name="student_id" readonly>
                                            <option selected value="{{ Session::get('id') }}">{{ Session::get('student') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="phone1">Telefone 1</label>
                                        <input type="text" class="form-control rounded-borders" id="phone1" name="phone1" placeholder="Telefone">
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="phone1_responsable">Responsável</label>
                                        <input type="text" class="form-control rounded-borders" id="phone1_responsable" name="phone1_responsable" placeholder="Responsável">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="phone2">Telefone 2</label>
                                        <input type="text" class="form-control rounded-borders" id="phone2" name="phone2" placeholder="Telefone">
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="phone2_responsable">Responsável</label>
                                        <input type="text" class="form-control rounded-borders" id="phone2_responsable" name="phone2_responsable" placeholder="Responsável">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="phone3">Telefone 3</label>
                                        <input type="text" class="form-control rounded-borders" id="phone3" name="phone3" placeholder="Telefone">
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="phone3_responsable">Responsável</label>
                                        <input type="text" class="form-control rounded-borders" id="phone3_responsable" name="phone3_responsable" placeholder="Responsável">
                                    </div>
                                </div>
                                <div class="form-row d-flex flex-row-reverse">
                                    <button type="submit" class="btn button-orange bg-orange rounded-borders">Continuar</button>
                                    <a href="{{route('admin.show.dashboard',$current_school_year)}}">
                                        <button type="button" class="btn btn-secondary rounded-borders">Cancelar</button>
                                    </a>
                                </div>
                            </form>
                        @else
                            @if(!(Session::has('enrollment_success')))
                                <form action="{{route('admin.store.student.enrollment1.submit',$current_school_year)}}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="student_id">Aluno</label>
                                            <select class="custom-select form-control  rounded-borders" name="student_id" readonly>
                                                <option selected value="{{ Session::get('id') }}">{{ Session::get('student') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="enrollment_code">Código da Matrícula</label>
                                            <input type="text" class="form-control rounded-borders" id="enrollment_code" name="enrollment_code" value="{{'ava'.date('ymd'). Session::get('id')}}" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="enrollment_date">Data da Matrícula</label>
                                            <input type="date" class="form-control rounded-borders" id="enrollment_date" name="enrollment_date" value="{{date('Y-m-d')}}" readonly required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="enrollment_year">Ano Letivo da Matrícula</label>
                                            <input type="text" class="form-control rounded-borders" id="enrollment_year" name="enrollment_year" value="" readonly required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="enrollment_status_id">Status da Matrícula</label>
                                            <select class="custom-select form-control  rounded-borders" name="enrollment_status_id" readonly>
                                                <option selected value="1">Ativa</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    <br>
                                    <h3>Requerente da Matrícula</h3>
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label for="name">Nome</label>
                                            <input type="text" class="form-control rounded-borders" id="name" name="name" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="cpf">CPF</label>
                                            <input type="text" class="form-control rounded-borders" id="cpf" name="cpf" maxlength="14" >
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="rg">RG</label>
                                            <input type="text" class="form-control rounded-borders" id="rg" name="rg">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="rg_emissor">Emissor do RG</label>
                                            <input type="text" class="form-control rounded-borders" id="rg_emissor" name="rg_emissor">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="degree_relatedness">Grau de parentesco</label>
                                            <input type="text" class="form-control rounded-borders" id="degree_relatedness" name="degree_relatedness" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="collaborator_id">Matrícula realizada por</label>
                                            <select class="custom-select form-control  rounded-borders" name="collaborator_id" readonly>
                                                <option selected value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row d-flex flex-row-reverse">
                                        <button type="submit" class="btn button-orange bg-orange rounded-borders">Continuar</button>
                                        <a href="{{route('admin.show.dashboard',$current_school_year)}}">
                                            <button type="button" class="btn btn-secondary rounded-borders">Cancelar</button>
                                        </a>
                                    </div>
                                </form>
                            @endif
                            
                        @endif
                        
                    @endif
                    
                @endif
                    
            @endif
        </div>
    </div>
</div>
@stop