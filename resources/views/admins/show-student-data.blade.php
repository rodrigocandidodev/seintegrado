@extends('layouts/pages')

@section('conteudo')

<div class="row">
    <div class="col-md-12 profile-banner">
        <div class="col-md-12 text-center">
            <strong><h1 class="text-white text-uppercase margin-top-100">{{$student_data->name}}</strong></h1>
        </div>
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-white rounded-borders" data-toggle="modal" data-target="#editDataModal">Editar Dados</button>
        </div>
        <div class="col-md-12 text-center">
            <div class="row">
                <div class="profile-banner-statistic col-md-2 text-center rounded-borders-10  box-shadow-set">
                    <a class="text-muted" href="">
                        <h1 class="margin-top-10">0</h1>
                        <p class="text-white">Média</p>
                    </a>
                </div>
                <div class="profile-banner-statistic col-md-2 text-center rounded-borders-10  box-shadow-set">
                    <a class="text-muted" href="#" data-toggle="modal" data-target="#AllAttendancesModal">
                        <h1 class="margin-top-10">{{$student_attendances_counter}}</h1>
                        <p class=" text-white">Faltas</p>
                    </a>
                </div>
                <div class="profile-banner-statistic col-md-2 text-center rounded-borders-10  box-shadow-set">
                    <a class="text-muted" href="{{route('admin.show.class.students',['year' => $current_school_year, 'class_id' => $current_institution_class_id])}}">
                        <h1 class="margin-top-10">{{$student_enrollment_data->institution_class}}</h1>
                        <p class=" text-white">Ir para a Turma</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container margin-top-100 bg-white box-shadow-set rounded-borders-10 profile-contents">
    <div class="row profile-actions">
        <div class="col">
            <div class="profile-inline-list-rectangles text-center bg-white">
                <a href="#" class="text-muted" data-toggle="modal" data-target="#declarationsModal"><p>Declarações</p></a>
            </div>
        </div>
        <div class="col">
            <div class="profile-inline-list-rectangles text-center bg-white">
                <a href="#" class="text-muted" data-toggle="modal" data-target="#rematricularYearModal"><p>Rematricular</p></a>
            </div>
        </div>
        <div class="col">
            <div class="profile-inline-list-rectangles text-center bg-white">
                <a href="#" class="text-muted" data-toggle="modal" data-target="#studentInternalTransferModal"><p>Trocar Turma</p></a>
            </div>
        </div>
        <div class="col">
            <div class="profile-inline-list-rectangles text-center bg-orange">
                <a class="text-white" target="_blank" href="{{route('admin.show.student.data.print',['id' => $student_data->id, 'year' => $current_school_year])}}"><p>Imprimir</p></a>
            </div>
        </div>
        <div class="col">
            <div class="profile-inline-list-rectangles text-center bg-orange">
                <a target="_blank" class="text-white" href="{{route('admin.show.student.data.excel',['id' => $student_data->id, 'year' => $current_school_year])}}"><p>Planilha</p></a>
            </div>
        </div>
    </div>

    <div class="row categories-box">
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Família</strong></h5>
            <strong>Mãe</strong><br>
            <span>{{$student_data->mother}}</span><br>

            <strong>Pai</strong><br>
            <span>{{$student_data->father}}</span><br>

            <strong>Resposável (eis) Leal (ais)</strong><br>
            <span>{{$student_data->legal_responsable}}</span><br>
        </div>
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Dados Pessoais</strong></h5>

            <strong>CPF</strong><br>
            <?php 
                //formatting cpf
                $part1 = substr($student_data->cpf,0,3);
                $part2 = substr($student_data->cpf,3,3);
                $part3 = substr($student_data->cpf,6,3);
                $part4 = substr($student_data->cpf,-2);
                $formatted_cpf = $part1.'.'.$part2.'.'.$part3.'-'.$part4;
             ?>
            <span>{{$formatted_cpf}}</span><br>

            <strong>SUS</strong><br>
            <span>{{$student_data->sus_number}}</span><br>
        </div>
    </div>
    <div class="row categories-box">
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Certidão de Nascimento - Parte 1</strong></h5>
            <strong>Data de Nascimento</strong><br>
            <span>{{date("d/m/Y", strtotime($student_data->date_birth))}}</span><br>

            <strong>Data de registro</strong><br>
            <span>{{date("d/m/Y", strtotime($student_data->date_cn))}}</span><br>

            <strong>Matrícula</strong><br>
            <span>{{$student_data->matricula_cn}}</span><br>
        </div>
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Certidão de Nascimento - Parte 2</strong></h5>
            <strong>Termo</strong><br>
            <span>{{$student_data->termo}}</span><br>

            <strong>Livro</strong><br>
            <span>{{$student_data->livro}}</span><br>

            <strong>Folha</strong><br>
            <span>{{$student_data->folha}}</span><br>
        </div>
    </div>
    <div class="row categories-box">
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Endereço</strong></h5>
            <strong>Rua</strong><br>
            <span>{{$student_data->street}}</span><br>

            <strong>Quadra</strong><br>
            <span>{{$student_data->block}}</span><br>

            <strong>Lote</strong><br>
            <span>{{$student_data->land_lot}}</span><br>

            <strong>Bairro</strong><br>
            <span>{{$student_data->neighborhood}}</span><br>

            <strong>CEP</strong><br>
            <span>{{$student_data->zipcode}}</span><br>

            <strong>Complemento</strong><br>
            <span>{{$student_data->complement}}</span><br>
        </div>
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Contato</strong></h5>
            <strong>Telefone 1</strong><br>
            <span>{{$student_data->phone1}}</span><br>

            <strong>Responsável pelo Telefone 1</strong><br>
            <span>{{$student_data->phone1_responsable}}</span><br>

            <strong>Telefone 2</strong><br>
            <span>{{$student_data->phone2}}</span><br>

            <strong>Responsável pelo Telefone 2</strong><br>
            <span>{{$student_data->phone2_responsable}}</span><br>

            <strong>Telefone 3</strong><br>
            <span>{{$student_data->phone3}}</span><br>

            <strong>Responsável pelo Telefone 3</strong><br>
            <span>{{$student_data->phone3_responsable}}</span><br>
        </div>
    </div>
    <hr>
    <div class="row categories-box">
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Matrícula - PARTE 1</strong></h5>
            <strong>Código</strong><br>
            <span>{{$student_enrollment_data->enrollment_code}}</span><br>

            <strong>Data da Matrícula</strong><br>
            <span>{{date("d/m/Y", strtotime($student_enrollment_data->enrollment_date))}}</span><br>

            <strong>Ano Letivo</strong><br>
            <span>{{$student_enrollment_data->enrollment_year}}</span><br>

            <strong>Número de Matrícula</strong><br>
            <span>{{$student_enrollment_data->enrollment_number}}</span><br>

            <strong>Turma</strong><br>
            <span>{{$student_enrollment_data->institution_class}}</span><br>

            <strong>Status</strong><br>
            <span>{{$student_enrollment_data->enrollment_status}}</span><br>

            <strong>Tipo de transferência</strong><br>
            <span>{{$student_enrollment_data->transfer_type}}</span><br>

            <strong>Data de transferência</strong><br>
            @if($student_enrollment_data->transfer_date == null)
                <span></span><br>
            @else
                <span>{{$student_enrollment_data->transfer_date}}</span><br>
            @endif
        </div>
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Matrícula - PARTE 2</strong></h5>
            <strong>Requerente</strong><br>
            <span>{{$student_enrollment_data->name}}</span><br>

            <strong>CPF</strong><br>
            <span>{{$student_enrollment_data->cpf}}</span><br>

            <strong>RG</strong><br>
            <span>{{$student_enrollment_data->rg . ' - ' . $student_enrollment_data->rg_emissor}}</span><br>

            <strong>Grau de Parentesco</strong><br>
            <span>{{$student_enrollment_data->degree_relatedness}}</span><br>

            <strong>Autorização para uso de imagem</strong><br>
            @if($student_data->auth_image_use=='on')
                <span>Sim</span><br>
            @else
                <span>Não</span><br>
            @endif

            <strong>Colaborador que fez a matrícula</strong><br>
            <span>{{$student_enrollment_collaborator->name}}</span><br>
        </div>
    </div>
    <div class="row categories-box">
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Saúde do Aluno</strong></h5>
            <strong>Necessidades Especiais</strong><br>
            <span>{{$student_data->health_special_needs}}</span><br>

            <strong>Problemas de Saúde</strong><br>
            <span>{{$student_data->health_problem}}</span><br>
        </div>
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Dados de Acesso do aluno</strong></h5>
            <strong>E-mail</strong><br>
            <span>{{$student_data->email}}</span><br>
        </div>
    </div>
</div>

<!-- Rematricular Modal -->
<div class="modal fade " id="rematricularYearModal" tabindex="-1" role="dialog" aria-labelledby="rematricularYearModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="rematricularYearModalTitle">Rematricular</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row text-center">
                <div class="col-md-12">
                    <p>Para qual ano letivo deseja rematricular?</p>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-md-12">
                    @foreach($all_school_years as $year_data)
                        <a href="{{route('admin.rematricular.student.data',['year' => $current_school_year, 'id' => $student_data->id,'next_year' => $year_data->year])}}">
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
<!-- FIM Rematricular Modal -->

<!-- Shifts Modal -->
<div class="modal fade " id="declarationsModal" tabindex="-1" role="dialog" aria-labelledby="declaracoesModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="declaracoesModalTitle">Declarações</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row text-center">
                <div class="col-md-12">
                    <p>Selecione o tipo de declaração que deseja emitir.</p>
                    <small><strong>OBS.: Ao emitir a declaração de transferência, o aluno é automaticamente transferido.</strong></small>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-md-12">
                    <a href="{{route('admin.show.student.declaration.print',['id' => $student_data->id,'year' => $current_school_year, 'type' => 'ESC'])}}" target="_blank">
                        <div class="modal-menu-lista rounded-borders col-md-2 bg-white outline">
                            <span class="p-2 text-dark">Escolaridade</span>
                        </div>
                    </a>
                    <a href="{{route('admin.show.student.declaration.print',['id' => $student_data->id,'year' => $current_school_year, 'type' => 'TRF1'])}}" target="_blank">
                        <div class="modal-menu-lista rounded-borders col-md-2 bg-white outline">
                            <span class="p-2 text-dark">Transferência fim de ano</span>
                        </div>
                    </a>
                    <a href="{{route('admin.show.student.declaration.print',['id' => $student_data->id,'year' => $current_school_year, 'type' => 'TRF2'])}}" target="_blank">
                        <div class="modal-menu-lista rounded-borders col-md-2 bg-white outline">
                            <span class="p-2 text-dark">Transferência meio de ano</span>
                        </div>
                    </a>
                </div>
            </div>
            <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIM Shifts Modal -->

<!-- Edit Data Modal -->
<div class="modal fade " id="editDataModal" tabindex="-1" role="dialog" aria-labelledby="editDataModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editDataModalTitle">Editar Dados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row text-center">
                <div class="col-md-12">
                    <p>Selecione o que deseja editar.</p>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-md-12">
                    <a href="#" data-toggle="modal" data-target="#studentUpdateModal">
                        <div class="modal-menu-lista rounded-borders col-md-3 bg-white outline">
                            <span class="p-2 text-dark">Dados</span>
                        </div>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#studentAddressModal">
                        <div class="modal-menu-lista rounded-borders col-md-3 bg-white outline">
                            <span class="p-2 text-dark">Endereço</span>
                        </div>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#studentCnModal">
                        <div class="modal-menu-lista rounded-borders col-md-3 bg-white outline">
                            <span class="p-2 text-dark">C. Nascimento</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-12">
                    <a href="#" data-toggle="modal" data-target="#studentContactModal">
                        <div class="modal-menu-lista rounded-borders col-md-3 bg-white outline">
                            <span class="p-2 text-dark">Contato</span>
                        </div>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#studentEnrollmentModal">
                        <div class="modal-menu-lista rounded-borders col-md-3 bg-white outline">
                            <span class="p-2 text-dark">Matrícula</span>
                        </div>
                    </a>
                </div>
            </div>
            <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIM Edit Data Modal -->

<!-- Students Update Modal -->
<div class="modal fade " id="studentUpdateModal" tabindex="-1" role="dialog" aria-labelledby="studentUpdateModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="studentUpdateModalTitle">Atualizar Dados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.update.student.data',['year' => $current_school_year, 'id' => $student_data->id])}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="institution_id">Instituição onde o aluno será matriculado</label>
                        <select class="custom-select form-control  rounded-borders" name="institution_id" id="institution_id" readonly>
                            <option value="{{$online_collaborator_institution_id}}">{{$online_institution_name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control rounded-borders" id="name" name="name" placeholder="Nome Completo do aluno" value="{{$student_data->name}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="date_birth">Data de Nascimento</label>
                        <input type="date" class="form-control rounded-borders" id="date_birth" name="date_birth" value="{{$student_data->date_birth}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="place_birth">Naturalidade</label>
                        <input type="text" class="form-control rounded-borders" id="place_birth" name="place_birth" placeholder="Local de Nascimento-UF" value="{{$student_data->place_birth}}">
                    </div>
                </div>
                

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>CPF (sem pontos e traços)</label>
                        <input type="text" class="form-control rounded-borders" name="cpf" placeholder="CPF" value="{{$student_data->cpf}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sus_number">Número do cartão do SUS (sem pontos e traços)</label>
                        <input type="text" class="form-control rounded-borders" id="sus_number" name="sus_number" placeholder="Número do cartão do SUS" value="{{$student_data->sus_number}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="father">Pai</label>
                        <input type="text" class="form-control rounded-borders" id="father " name="father" placeholder="Nome Completo do pai" value="{{$student_data->father}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mother">Mãe</label>
                        <input type="text" class="form-control rounded-borders" id="mother" name="mother" placeholder="Nome Completo da mãe" value="{{$student_data->mother}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="legal_responsable">Responsável Legal</label>
                        <input type="text" class="form-control rounded-borders" id="legal_responsable" name="legal_responsable" placeholder="Responsável Legal" value="{{$student_data->legal_responsable}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="health_special_needs">Necessidade Especial</label>
                        <input type="text" class="form-control rounded-borders" id="health_special_needs" name="health_special_needs" placeholder="Necessidade Especial" value="{{$student_data->health_special_needs}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="health_problem">Problema de Saúde</label>
                        <input type="text" class="form-control rounded-borders" id="health_problem" name="health_problem" placeholder="Problema de Saúde" value="{{$student_data->health_problem}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control rounded-borders" id="email_responsable" name="email" placeholder="E-mail válido" value="{{$student_data->email}}">
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn button-orange rounded-borders">Atualizar</button>
            </form>
      </div>
    </div>
  </div>
</div>
<!-- FIM Students Update Modal -->

<!-- Student Address Update Modal -->
<div class="modal fade " id="studentAddressModal" tabindex="-1" role="dialog" aria-labelledby="studentAddressModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="studentAddressModalTitle">Atualizar Dados - Endereço</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.update.student.address',['year' => $current_school_year, 'id' => $student_data->id])}}" method="POST">
                {!! csrf_field()!!}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="student_id">Aluno</label>
                        <select class="custom-select form-control  rounded-borders" name="student_id" readonly>
                            <option selected value="{{$student_data->id}}">{{$student_data->name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="street">Ano Letivo</label>
                        <input type="text" class="form-control rounded-borders" id="enrollment_year" name="enrollment_year" placeholder="Ano Letivo" value="{{$student_enrollment_data->enrollment_year}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="street">Rua</label>
                        <input type="text" class="form-control rounded-borders" id="street" name="street" placeholder="Rua" value="{{$student_data->street}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="block">Quadra</label>
                        <input type="text" class="form-control rounded-borders" id="block" name="block" placeholder="Quadra" value="{{$student_data->block}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="land_lot">Lote</label>
                        <input type="text" class="form-control rounded-borders" id="land_lot" name="land_lot" placeholder="Lote" value="{{$student_data->land_lot}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="number">Número</label>
                        <input type="text" class="form-control rounded-borders" id="number" name="number" placeholder="Número" value="{{$student_data->number}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="neighborhood">Bairro</label>
                        <input type="text" class="form-control rounded-borders" id="neighborhood" name="neighborhood" placeholder="Bairro" value="{{$student_data->neighborhood}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="zipcode">CEP</label>
                        <input type="text" class="form-control rounded-borders" id="zipcode" name="zipcode" placeholder="CEP" value="{{$student_data->zipcode}}">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="complement">Complemento</label>
                        <input type="text" class="form-control rounded-borders" id="complement" name="complement" value="{{$student_data->complement}}">
                    </div>
                </div>
                <div class="form-row">
                    <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn button-orange rounded-borders">Atualizar</button>
                </div>
            </form>
            
      </div>
    </div>
  </div>
</div>
<!-- FIM Students Address Modal -->

<!-- Student Cn Update Modal -->
<div class="modal fade " id="studentCnModal" tabindex="-1" role="dialog" aria-labelledby="studentCnModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="studentCnModalTitle">Atualizar Dados - Certidão de Nascimento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.update.student.cn',['year' => $current_school_year, 'id' => $student_data->id])}}" method="POST">
                {!! csrf_field()!!}
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
                        <label for="matricula_cn">Matrícula da Certidão de Nascimento</label>
                        <input type="text" class="form-control rounded-borders" id="matricula_cn" name="matricula_cn" placeholder="Matrícula" value="{{$student_data->matricula_cn}}">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="date_cn">Data da Certidão de Nascimento</label>
                        <input type="date" class="form-control rounded-borders" id="date_cn" name="date_cn" value="{{$student_data->date_cn}}">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="termo">Termo</label>
                        <input type="text" class="form-control rounded-borders" id="termo" name="termo" placeholder="Número do Termo sem pontos e traços" value="{{$student_data->termo}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="livro">Livro</label>
                        <input type="text" class="form-control rounded-borders" id="livro" name="livro" placeholder="Livro" value="{{$student_data->livro}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="folha">Folha</label>
                        <input type="text" class="form-control rounded-borders" id="folha" name="folha" placeholder="Folha" value="{{$student_data->folha}}">
                    </div>
                </div>
                <div class="form-row">
                    <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn button-orange rounded-borders">Atualizar</button> 
                </div>
            </form>
            
      </div>
    </div>
  </div>
</div>
<!-- FIM Students Cn Modal -->

<!-- Student Contact Update Modal -->
<div class="modal fade " id="studentContactModal" tabindex="-1" role="dialog" aria-labelledby="studentContactModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="studentContactModalTitle">Atualizar Dados - Contato</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.update.student.contact',['year' => $current_school_year, 'id' => $student_data->id])}}" method="POST">
                {!! csrf_field()!!}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="student_id">Aluno</label>
                        <select class="custom-select form-control  rounded-borders" name="student_id" readonly>
                            <option selected value="{{$student_data->id}}">{{$student_data->name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="enrollment_year">Ano Letivo da matrícula</label>
                        <input type="text" class="form-control rounded-borders" id="enrollment_year" name="enrollment_year" placeholder="Ano Letivo" value="{{$student_enrollment_data->enrollment_year}}" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="phone1">Telefone 1</label>
                        <input type="text" class="form-control rounded-borders" id="phone1" name="phone1" placeholder="Telefone" value="{{$student_data->phone1}}">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="phone1_responsable">Responsável</label>
                        <input type="text" class="form-control rounded-borders" id="phone1_responsable" name="phone1_responsable" placeholder="Responsável" value="{{$student_data->phone1_responsable}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="phone2">Telefone 2</label>
                        <input type="text" class="form-control rounded-borders" id="phone2" name="phone2" placeholder="Telefone" value="{{$student_data->phone2}}">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="phone2_responsable">Responsável</label>
                        <input type="text" class="form-control rounded-borders" id="phone2_responsable" name="phone2_responsable" placeholder="Responsável" value="{{$student_data->phone2_responsable}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="phone3">Telefone 3</label>
                        <input type="text" class="form-control rounded-borders" id="phone3" name="phone3" placeholder="Telefone" value="{{$student_data->phone3}}">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="phone3_responsable">Responsável</label>
                        <input type="text" class="form-control rounded-borders" id="phone3_responsable" name="phone3_responsable" placeholder="Responsável" value="{{$student_data->phone3_responsable}}">
                    </div>
                </div>
                <div class="form-row">
                    <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn button-orange rounded-borders">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
<!-- FIM Students Contact Modal -->

<!-- Student Enrollment Update Modal -->
<div class="modal fade " id="studentEnrollmentModal" tabindex="-1" role="dialog" aria-labelledby="studentEnrollmentModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="studentEnrollmentModalTitle">Atualizar Dados - Matrícula</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.update.student.enrollment',['year' => $current_school_year, 'id' => $student_data->id])}}" method="POST">
                {!! csrf_field()!!}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="institution_id">Instituição onde o aluno será matriculado</label>
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
                        <input type="text" class="form-control rounded-borders" id="enrollment_code" name="enrollment_code" value="{{$student_enrollment_data->enrollment_code}}" readonly >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="enrollment_date">Data da Matrícula</label>
                        <input type="date" class="form-control rounded-borders" id="enrollment_date" name="enrollment_date" value="{{$student_enrollment_data->enrollment_date}}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="enrollment_year">Ano Letivo da Matrícula</label>
                        <input type="text" class="form-control rounded-borders" id="enrollment_year" name="enrollment_year" value="{{$student_enrollment_data->enrollment_year}}" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="select_institution_class">Turma</label>
                        <small><strong>(OBS.: Edite este campo somente se tiver matriculado na turma errada, não use como transferência interna!)</strong></small>
                        <select class="custom-select form-control  rounded-borders" name="institution_class_id" id="select_institution_class">
                            <option selected value="{{$student_enrollment_data->institution_class_id}}">{{$student_enrollment_data->institution_class}}</option>
                            @foreach($each_class_amount as &$c)
                                <option value="{{$c['id']}}">{{$c['institution_class']}} - {{$c['amount']}} Alunos</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <h3>Requerente da Matrícula</h3>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control rounded-borders" id="name" name="name" value="{{$student_enrollment_data->name}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control rounded-borders" id="cpf" name="cpf" value="{{$student_enrollment_data->cpf}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="rg">RG</label>
                        <input type="text" class="form-control rounded-borders" id="rg" name="rg" value="{{$student_enrollment_data->rg}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="rg_emissor">Emissor do RG</label>
                        <input type="text" class="form-control rounded-borders" id="rg_emissor" name="rg_emissor" value="{{$student_enrollment_data->rg_emissor}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="degree_relatedness">Grau de parentesco</label>
                        <input type="text" class="form-control rounded-borders" id="degree_relatedness" name="degree_relatedness" value="{{$student_enrollment_data->degree_relatedness}}">
                    </div>
                </div>
                <div class="form-row">
                    <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn button-orange rounded-borders">Atualizar</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
<!-- FIM Students Enrollment Modal -->

<!-- Internal Transfer Modal -->
<div class="modal fade " id="studentInternalTransferModal" tabindex="-1" role="dialog" aria-labelledby="studentInternalTransferModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="studentInternalTransferModalTitle">Transferência Interna</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.internal.transfer.submit',['year' => $current_school_year, 'student_id' => $student_data->id])}}" method="POST">
                {!! csrf_field()!!}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="institution_id">Instituição onde o aluno será matriculado</label>
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
                    <div class="form-group col-md-6">
                        <label for="enrollment_code">Código da Matrícula</label>
                        <input type="text" class="form-control rounded-borders" id="enrollment_code" name="enrollment_code" value="{{'ava'.$student_enrollment_data->enrollment_year.date('ymd'). $student_data->id}}" readonly >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="enrollment_number">Número da Matrícula</label>
                        <input type="text" class="form-control rounded-borders" id="enrollment_number" name="enrollment_number" value="{{$student_enrollment_data->enrollment_number}}" readonly >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="enrollment_date">Nova Data da Matrícula</label>
                        <input type="date" class="form-control rounded-borders" id="enrollment_date" name="enrollment_date" value="{{date('Y-m-d')}}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="enrollment_year">Ano Letivo da Matrícula</label>
                        <input type="text" class="form-control rounded-borders" id="enrollment_year" name="enrollment_year" value="{{$student_enrollment_data->enrollment_year}}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="enrollment_status_id">Status da Matrícula</label>
                        <select class="custom-select form-control rounded-borders" name="enrollment_status_id" readonly>
                            <option selected value="1">Ativa</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="select_institution_class">Nova Turma</label>
                        <select class="custom-select form-control  rounded-borders" name="institution_class_id" id="select_institution_class">
                            <option value="">Selecione</option>
                            @foreach($each_class_amount as &$c)
                                <option value="{{$c['id']}}">{{$c['institution_class']}} - {{$c['amount']}} Alunos</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <h3>Requerente da Matrícula</h3>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control rounded-borders" id="name" name="name" value="{{$student_enrollment_data->name}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control rounded-borders" id="cpf" name="cpf" value="{{$student_enrollment_data->cpf}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="rg">RG</label>
                        <input type="text" class="form-control rounded-borders" id="rg" name="rg" value="{{$student_enrollment_data->rg}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="rg_emissor">Emissor do RG</label>
                        <input type="text" class="form-control rounded-borders" id="rg_emissor" name="rg_emissor" value="{{$student_enrollment_data->rg_emissor}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="degree_relatedness">Grau de parentesco</label>
                        <input type="text" class="form-control rounded-borders" id="degree_relatedness" name="degree_relatedness" value="{{$student_enrollment_data->degree_relatedness}}">
                    </div>
                </div>
                <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="select_collaborator">Transferência Interna realizada por</label>
                            <select class="custom-select form-control  rounded-borders" name="collaborator_id" id="select_collaborator" readonly>
                                <option selected value="{{$collaborator_id}}">{{$online_collaborator_name}}</option>
                            </select>
                        </div>
                    </div>
                <div class="form-row">
                    <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn button-orange rounded-borders">Transferir</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
<!-- ENDING Internal Transfer Modal -->

<!-- Attendances Modal -->
<div class="modal fade " id="AllAttendancesModal" tabindex="-1" role="dialog" aria-labelledby="AllAttendancesModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AllAttendancesModalTitle">Faltas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row text-center">
                <div class="col-md-12">
                    <a class="text-muted" href="#" data-toggle="modal" data-target="#AttendanceModal">Lançar Falta</a>
                </div>
                
            </div>
            <div class="row text-center">
                <?php $counter = 1; ?>
                @foreach($student_attendances as $data)
                    <div class="inline-list-rectangles text-center bg-white">
                        <a class="text-muted" href="#">
                            <p class="margin-top-10">{{$counter.' - '.date('d/m/Y',strtotime($data->day))}}</p>
                        </a>
                    </div>
                    <?php $counter++; ?>
                @endforeach
            </div>
      </div>
    </div>
  </div>
</div>
<!-- FIM Attendances Modal -->
<!-- Attendance Modal -->
<div class="modal fade " id="AttendanceModal" tabindex="-1" role="dialog" aria-labelledby="AttendanceModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AttendanceModalTitle">Lançar Faltas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.attendance.class.students',[
                'year'      => $current_school_year, 
                'class_id'  => $class_id
            ])}}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <small>Ao lançar a falta, o aluno receberá a falta em tudas as aulas do dia</small>
                </div>
                <div class="form-group col-md-12">
                    <label for="institution">Instituição</label>
                    <select class="custom-select form-control  rounded-borders" name="institution_id" id="institution_id" readonly required>
                        <option value="{{$online_collaborator_institution_id}}">{{$online_institution_name}}</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="date_class">Data da falta</label>
                    <input type="date" class="form-control rounded-borders" id="date_class" name="day" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="student">Aluno</label>
                    <select class="custom-select form-control  rounded-borders" name="student_id" id="student" required>
                        <option value="{{$student_data->id}}">{{$student_data->name}}</option>
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
<!-- Ending Attendance Modal -->
@stop