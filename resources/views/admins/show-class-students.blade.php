@extends('layouts/pages')

@section('conteudo')

    <div class="container">
        <div class="row">
            <div class="painel-list">
                <h3 class="text-center">{{$current_institution_class}}</h3>

                @if(Session::has('message'))
                    <div class="p-3 mb-2 bg-orange text-white text-center rounded-borders" id="notification_tab">{{ Session::get('message') }}</div>
                @endif
                
                <br>
                <ul class="list-group">
                    <ul class="nav justify-content-center">
                      <li class="nav-item menu-down-upon-content">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#matricularModal">Matricular Aluno</a>
                      </li>
                      <li class="nav-item menu-down-upon-content">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#turmaModal">Outras Turmas</a>
                      </li>
                      <li class="nav-item menu-down-upon-content">
                        <a class="nav-link" target="_blank" href="{{route('admin.show.class.students.data.pdf',['class_id' => $current_institution_class_id, 'year' => $current_school_year])}}">Imprimir</a>
                      </li>
                      <li class="nav-item menu-down-upon-content">
                        <a class="nav-link" href="{{route('admin.show.class.students.data.sheet',['class_id' => $current_institution_class_id, 'year' => $current_school_year])}}">Exportar Planilha</a>
                      </li>
                    </ul>
                    <ul class="nav justify-content-center ">
                      <li class="nav-item menu-down-upon-content">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#AttendanceModal">Lançar Faltas</a>
                      </li>
                      <li class="nav-item menu-down-upon-content">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#previsionModal">Previsão</a>
                      </li>

                      <li class="nav-item menu-down-upon-content">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#TeacherOfThisClassModal">Professor(es) da Turma</a>
                      </li>
                    </ul>
                    <li class="painel-list-item bg-orange text-white">
                        <ul class="list-group painel-list-cel">
                            <span class="badge painel-list-item-index">#</span>
                            <li class="list-group-item painel-list-name-cel bg-transparent">Nome</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent">Data de Nascimento</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent">Data de Matrícula</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent">Telefone</li>
                        </ul>
                    </li>
                    @foreach($students_data as $data)
                        <a href="{{route('admin.show.student.data.byclass',['year' => $current_school_year, 'id' => $data->id, 'class_id' => $data->institution_class_id])}}">
                            <li class="painel-list-item">
                                <ul class="list-group painel-list-cel">
                                    <span class="badge painel-list-item-index">{{$counter++}}</span>
                                    <li class="list-group-item  painel-list-name-cel">{{$data->name}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{date("d/m/Y", strtotime($data->date_birth))}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{date("d/m/Y", strtotime($data->enrollment_date))}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{$data->phone1}}</li>
                                </ul>
                            </li>
                        </a>
                        
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row mt-3">
            <div class="painel-list">
                <h3 class="text-center">Alunos Transferidos e/ou Movidos</h3>
                <br>
                <ul class="list-group">
                    <li class="painel-list-item bg-orange text-white">
                        <ul class="list-group painel-list-cel">
                            <span class="badge painel-list-item-index">#</span>
                            <li class="list-group-item painel-list-name-cel bg-transparent">Nome</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent">Data de Nascimento</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent">Data de Matrícula</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent ">Telefone</li>
                        </ul>
                    </li>
                    @foreach($inactive_students_data as $data)
                        <a href="{{route('admin.show.student.data.byclass',['year'=>$current_school_year,'id'=>$data->id,'class_id' => $data->institution_class_id])}}">
                            <li class="painel-list-item">
                                <ul class="list-group painel-list-cel">
                                    <span class="badge painel-list-item-index">{{$inactive_students_counter++}}</span>
                                    <li class="list-group-item  painel-list-name-cel">{{$data->name}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{date("d/m/Y", strtotime($data->date_birth))}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{date("d/m/Y", strtotime($data->enrollment_date))}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{$data->phone1}}</li>
                                </ul>
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row mt-3">
            <div class="painel-list">
                <h3 class="text-center">Lista de Espera</h3>
                <br>
                <ul class="list-group">
                    <ul class="nav justify-content-center">

                      <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#newWaitingListCandidateModal">Adicionar Candidato</a>
                      </li>
                    </ul>
                    <li class="painel-list-item bg-orange text-white">
                        <ul class="list-group painel-list-cel">
                            <span class="badge painel-list-item-index">#</span>
                            <li class="list-group-item painel-list-name-cel bg-transparent">Nome</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent">Responsável</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent">Data de Solicitação</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent">Telefone</li>
                        </ul>
                    </li>
                    <?php $counter = 1; ?>
                    @foreach($waiting_list_data as $data)
                    <!-- Waiting List actions Modal -->
                        <div class="modal fade " id="WaitingListActionsModal{{$counter}}" tabindex="-1" role="dialog" aria-labelledby="WaitingListActionsModalTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="WaitingListActionsModalTitle">Ações</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row text-center">
                                        <div class="col-md-12">
                                            <p>Selecione a ação desejada</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="list-group list-group-flush">
                                                <a href="{{route('admin.delete.student.waiting.list',['year' => $current_school_year, 'candidate_id' => $data->id,'class_id' => $current_institution_class_id])}}">
                                                    <li class="list-group-item">Remover</li>
                                                </a>
                                            </ul>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <!-- ENDING Waiting List actions Modal -->
                        <a href="#" data-toggle="modal" data-target="#WaitingListActionsModal{{$counter}}">
                            <li class="painel-list-item">
                                <ul class="list-group painel-list-cel">
                                    <span class="badge painel-list-item-index">{{$counter++}}</span>
                                    <li class="list-group-item  painel-list-name-cel">{{$data->candidate_name}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{$data->responsable}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{date("d/m/Y", strtotime($data->created_at))}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{$data->phone}}</li>
                                </ul>
                            </li>
                        </a>
                        
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- Matricular Modal -->
    <div class="modal fade " id="matricularModal" tabindex="-1" role="dialog" aria-labelledby="matricularModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="matricularModalTitle">Novo Aluno</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.store.student.maindata',$current_school_year)}}" method="POST">
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
                        <input type="text" class="form-control rounded-borders" id="name" name="name" placeholder="Nome Completo do aluno" required>
                    </div>
                </div>
                <div class="form-row">
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
                        <label>CPF (sem pontos e traços)</label>
                        <input type="text" class="form-control rounded-borders" name="cpf" placeholder="CPF" maxlength="11" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sus_number">Número do cartão do SUS</label>
                        <input type="text" class="form-control rounded-borders" id="sus_number" name="sus_number" placeholder="Número do cartão do SUS" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="gender_id">Gênero</label>
                        <select class="custom-select form-control  rounded-borders" name="gender_id" required>
                            <option selected>Selecione o gênero</option>
                            @foreach($genders as $gender)
                                <option value="{{$gender->id}}">{{$gender->gender}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="color_id">Cor</label>
                        <select class="custom-select form-control  rounded-borders" name="color_id" required>
                            <option selected>Selecione a cor</option>
                            @foreach($colors as $color)
                                <option value="{{$color->id}}">{{$color->color}}</option>
                            @endforeach
                        </select>
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
                    <div class="form-group col-md-6">
                        <label for="legal_responsable">Responsável Legal</label>
                        <input type="text" class="form-control rounded-borders" id="legal_responsable" name="legal_responsable" placeholder="Responsável Legal" required>
                    </div>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="auth_image_use" name="auth_image_use">
                    <label class="form-check-label" for="auth_image_use">Autorizar uso de imagem</label>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="health_special_needs">Necessidade Especial</label>
                        <input type="text" class="form-control rounded-borders" id="health_special_needs" name="health_special_needs" placeholder="Necessidade Especial" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="health_problem">Problema de Saúde</label>
                        <input type="text" class="form-control rounded-borders" id="health_problem" name="health_problem" placeholder="Problema de Saúde" >
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
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn button-orange rounded-borders">Continuar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Matricular Modal -->

    <!-- Turma Modal -->
    <div class="modal fade " id="turmaModal" tabindex="-1" role="dialog" aria-labelledby="turmaModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="turmaModalTitle">Turmas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <a href="#" data-toggle="modal" data-target="#novaturmaModal">Nova turma</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($each_class_amount as &$c)
                    <div class="inline-list-rectangles text-center bg-white">
                        <a class="text-muted" href="{{route('admin.show.class.students',[$current_school_year, $c['id']])}}">
                            <h5 class="margin-top-10">{{$c['institution_class']}}</h5>
                            <p>{{$c['amount']}} Alunos</p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- FIM Turmas Modal -->
    
    <!-- New Candidate Waiting List Modal -->
    <div class="modal fade " id="newWaitingListCandidateModal" tabindex="-1" role="dialog" aria-labelledby="newCandidateWaitingListModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newCandidateWaitingListModalTitle">Novo Candidato - Lista de Espera</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row text-center">
                <div class="col-md-12">
                    <a href="#" data-toggle="modal" data-target="#turmaModal">Visualizar Lista</a>
                </div>
            </div>
            <hr>
            <form action="{{route('admin.store.student.waiting.list.submit',['year' => $current_school_year, 'page' => 'class_students'])}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="institution">Instituição</label>
                        <select class="custom-select form-control  rounded-borders" name="institution_id" id="institution_id" readonly required>
                            <option value="{{$online_collaborator_institution_id}}">{{$online_institution_name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_year">Ano Letivo</label>
                        <input type="text" class="form-control rounded-borders" id="input_year" name="enrollment_year" required readonly value="{{$current_school_year}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_institution_class">Turma</label>
                        <select class="custom-select form-control  rounded-borders" name="institution_class_id" id="input_institution_class" required readonly>
                            <option value="{{$current_institution_class_id}}">{{$current_institution_class}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_name">Nome do Candidato</label>
                        <input type="text" class="form-control rounded-borders" id="input_name" name="candidate_name" placeholder="Nome Completo" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_responsable">Nome do Responsável</label>
                        <input type="text" class="form-control rounded-borders" id="input_responsable" name="responsable" placeholder="Nome Completo" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_responsable">Telefone para contato</label>
                        <input type="text" class="form-control rounded-borders" id="input_responsable" name="phone" placeholder="Nome Completo" required>
                    </div>
                </div>

                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn button-orange rounded-borders">Continuar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Ending New Candidate Waiting List Modal -->

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
                    'class_id'  => $current_institution_class_id
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
                            <?php $counter = 1; ?>
                            @foreach($students_data as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach
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
    <!-- Prevision Modal -->
    <div class="modal fade " id="previsionModal" tabindex="-1" role="dialog" aria-labelledby="previsionModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="previsionModalTitle">Previsões</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('prevision',[
                    'year'      => $current_school_year, 
                    'class_id'  => $current_institution_class_id
                ])}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="component">Componente Curricular</label>
                        <select class="custom-select form-control  rounded-borders" name="curricular_component_id" id="component" required>
                            @foreach($curricular_components as $data)
                                <option value="{{$data->id}}">{{$data->component}}</option>
                            @endforeach
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
    <!-- Ending Prevision Modal -->

    <!-- Teachers of this class Modal -->
    <div class="modal fade " id="TeacherOfThisClassModal" tabindex="-1" role="dialog" aria-labelledby="TeacherOfThisClassModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TeacherOfThisClassModalTitle">Professor (es) da turma</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <a href="#" data-toggle="modal" data-target="#TeacherClassesModal">Vincular Professor</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($teacher_classes_list as &$data)
                    <div class="inline-list-rectangles text-center bg-white">
                        <a class="text-muted" href="#">
                            <h5 class="margin-top-10">{{$data->name}}</h5>
                            <p>{{$data->component}}</p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- Ending Teachers of this class Modal -->

    <!-- New Teacher Classes Modal -->
    <div class="modal fade " id="TeacherClassesModal" tabindex="-1" role="dialog" aria-labelledby="TeacherClassesModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="TeacherClassesModalTitle">Vincular Professor à turma</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.teacehr.classes.submit',['year' => $current_school_year, 'class_id' => $current_institution_class_id])}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="institution">Instituição</label>
                        <select class="custom-select form-control  rounded-borders" name="institution_id" id="institution_id" readonly required>
                            <option value="{{$online_collaborator_institution_id}}">{{$online_institution_name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Ano Letivo</label>
                        <select class="custom-select form-control  rounded-borders" name="school_year_id" readonly required>
                            <option value="{{$school_year_id->id}}">{{$current_school_year}}</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input_institution_class">Turma</label>
                        <select class="custom-select form-control  rounded-borders" name="institution_class_id" id="input_institution_class" required readonly>
                            <option value="{{$current_institution_class_id}}">{{$current_institution_class}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Professor</label>
                        <select class="custom-select form-control  rounded-borders" name="teacher_id" required>
                            <option>Selecione uma opção</option>
                            @foreach($teachers as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="component">Componente Curricular</label>
                        <select class="custom-select form-control  rounded-borders" name="curricular_component_id" id="component" required>
                            <option>Selecione uma opção</option>
                            @foreach($curricular_components as $data)
                                <option value="{{$data->id}}">{{$data->component}}</option>
                            @endforeach
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
    <!-- Ending Teacher Classes Modal -->
@stop