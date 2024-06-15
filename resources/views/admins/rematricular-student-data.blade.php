@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-grid rounded-borders">
                <div class="painel-box">
                    <h3 class="text-center">Rematricular</h3>
                    <hr>
                    <form action="{{route('admin.store.student.class.rematricular.submit',$current_school_year)}}" id="form_enrollment" method="POST">
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
                                <label for="student_id">Aluno</label>
                                <select class="custom-select form-control  rounded-borders" name="student_id" readonly>
                                    <option selected value="{{$student_data->id}}">{{$student_data->name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="enrollment_code">Código da Matrícula</label>
                                <input type="text" class="form-control rounded-borders" id="enrollment_code" name="enrollment_code" value="{{'ava'.$next_year.date('ymd'). $student_data->id}}" readonly required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="enrollment_date">Data da Matrícula</label>
                                <input type="date" class="form-control rounded-borders" id="enrollment_date" name="enrollment_date" value="{{date('Y-m-d')}}" readonly required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="enrollment_year">Ano Letivo da Matrícula</label>
                                <input type="text" class="form-control rounded-borders" id="enrollment_year" name="enrollment_year" value="{{$next_year}}" readonly required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="enrollment_status_id">Status da Matrícula</label>
                                <select class="custom-select form-control  rounded-borders" name="enrollment_status_id" readonly>
                                    <option selected value="1">Ativa</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="institution_class_id">Turma em {{$next_year}}</label>
                                <select class="custom-select form-control  rounded-borders" name="institution_class_id">
                                    @foreach($all_institution_classes as $classes)
                                        <option selected value="{{$classes->id}}">{{$classes->institution_class}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <h3>Endereço</h3>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="street">Rua</label>
                                <input type="text" class="form-control rounded-borders" id="street" name="street" placeholder="Rua">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="block">Quadra</label>
                                <input type="text" class="form-control rounded-borders" id="block" name="block" placeholder="Quadra">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="land_lot">Lote</label>
                                <input type="text" class="form-control rounded-borders" id="land_lot" name="land_lot" placeholder="Lote">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="number">Número</label>
                                <input type="text" class="form-control rounded-borders" id="number" name="number" placeholder="Número">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="neighborhood">Bairro</label>
                                <input type="text" class="form-control rounded-borders" id="neighborhood" name="neighborhood" placeholder="Bairro">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="zipcode">CEP</label>
                                <input type="text" class="form-control rounded-borders" id="zipcode" name="zipcode" placeholder="CEP" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="complement">Complemento</label>
                                <input type="text" class="form-control rounded-borders" id="complement" name="complement">
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
                                <input type="text" class="form-control rounded-borders" id="cpf" name="cpf" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="rg">RG</label>
                                <input type="text" class="form-control rounded-borders" id="rg" name="rg">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="rg_emissor">Emissor do RG</label>
                                <input type="text" class="form-control rounded-borders" id="rg_emissor" name="rg_emissor" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="degree_relatedness">Grau de parentesco</label>
                                <input type="text" class="form-control rounded-borders" id="degree_relatedness" name="degree_relatedness" required>
                            </div>
                        </div>
                        <h3>Contato</h3>
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
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="collaborator_id">Matrícula realizada por</label>
                                <select class="custom-select form-control  rounded-borders" name="collaborator_id" readonly>
                                    <option selected value="{{$online_collaborator_id}}">{{$online_collaborator_name}}</option>
                                </select>
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn button-orange rounded-borders">Continuar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@stop