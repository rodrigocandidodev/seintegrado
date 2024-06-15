@extends('layouts/pages')

@section('conteudo')
    <!--STICKY-MENU-BAR-->
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-center">
            <div class="dashboard-values rounded-borders  col-2 bg-white outline">
                <a class="p-2 text-dark" href="#" data-toggle="modal" data-target="#allStudentsModal"><span>{{$amount_active_students}}</span> Alunos</a>
            </div>
            <div class="dashboard-values rounded-borders  col-2 bg-white">
                <a class="p-2 text-dark" href="#" data-toggle="modal" data-target="#turmaModal"><span>{{$amount_classes}}</span> Turmas</a>
            </div>
            <div class="dashboard-values rounded-borders  col-2 bg-white">
                <a class="p-2 text-dark" href="#" data-toggle="modal" data-target="#collaboratorModal"><span>{{$amount_collaborators}}</span> Colaboradores</a>
            </div>
        </nav>
        <hr>   
    </div>
    <!--GRID-MENU-->
    <div class="container">
        <div class="row">
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#matricularModal">
                    <h1 class="margin-top-10">Mt</h1>
                    <p>Matricular</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#newWaitingListCandidateModal">
                    <h1 class="margin-top-10">LE</h1>
                    <p>Lista de Espera</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#alunoModal">
                    <h1 class="margin-top-10">Al</h1>
                    <p>Aluno</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#turmaModal">
                    <h1 class="margin-top-10">Tm</h1>
                    <p>Turma</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#newCollaboratorModal">
                    <h1 class="margin-top-10">NC</h1>
                    <p>Novo Colaborador</p>
                </a>
            </div>
            
        </div>
        <div class="row">
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="{!! route('admin.config', $current_school_year); !!}">
                    <h1 class="margin-top-10">Cf</h1>
                    <p>Configurações</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#collaboratorModal">
                    <h1 class="margin-top-10">Cb</h1>
                    <p>Colaborador</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="{!! route('admin.show.teachers',$current_school_year); !!}">
                    <h1 class="margin-top-10">Pf</h1>
                    <p>Professores</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#newTeacherModal">
                    <h1 class="margin-top-10">NP</h1>
                    <p>Novo Professor</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="{!! route('admin.calendar',$current_school_year); !!}">
                    <h1 class="margin-top-10">Cl</h1>
                    <p>Calendário</p>
                </a>
            </div>
        </div>
    </div>
    <hr> 
    <div class="container mt-3">
        <div class="row">
            <div class="painel-list">
                <h5 class="text-center">Alunos Matriculados Recentemente</h5>
                <br>
                <ul class="list-group">
                    <li class="painel-list-item bg-white ">
                        <ul class="list-group painel-list-cel">
                            <span class="badge painel-list-item-index">#</span>
                            <li class="list-group-item painel-list-name-cel bg-white">Nome</li>
                            <li class="list-group-item painel-list-cel-item bg-white">Data de Nascimento</li>
                            <li class="list-group-item painel-list-cel-item bg-white">Data de Matrícula</li>
                            <li class="list-group-item painel-list-cel-item bg-white ">Turma</li>
                        </ul>
                    </li>
                    @foreach($latest_student_registers as $lr)
                    <a href="{{route('admin.show.student.data.byclass',['year' => $current_school_year,'id' => $lr->id,'class_id' => $lr->institution_class_id])}}">
                        <li class="painel-list-item bg-white ">
                            <ul class="list-group painel-list-cel">
                                <span class="badge painel-list-item-index">{{$latest_registers_counter++}}</span>
                                <li class="list-group-item painel-list-name-cel bg-white">{{$lr->name}}</li>
                                <li class="list-group-item painel-list-cel-item bg-white">{{date("d/m/Y", strtotime($lr->date_birth))}}</li>
                                <li class="list-group-item painel-list-cel-item bg-white">{{date("d/m/Y", strtotime($lr->enrollment_date))}}</li>
                                <li class="list-group-item painel-list-cel-item bg-white">{{$lr->institution_class}}</li>
                            </ul>
                        </li>
                    </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Collaborator Modal -->
    <div class="modal fade " id="collaboratorModal" tabindex="-1" role="dialog" aria-labelledby="collaboratorModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="collaboratorModalTitle">Colaborador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                    <div class="col-md-12">
                        <label for="search_collaborator">Nome</label><br>
                        <div class="form-search">
                            <input type="text" name="name_search" id="search_collaborator" placeholder="Nome do Colaborador" required>
                            <div class="resultado_collaborator">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-md-12">
                        <a href="#" data-toggle="modal" data-target="#collaboratorCpfSearchModal">
                            <small>Pesquisar por CPF</small>
                        </a>
                        <br>
                        <a href="{{route('admin.show.collaborators',$current_school_year)}}">
                            <small>Ver todos os colaboradores</small>
                        </a>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Collaborator Modal -->

    <!-- Collaborator cpf search Modal -->
    <div class="modal fade " id="collaboratorCpfSearchModal" tabindex="-1" role="dialog" aria-labelledby="collaboratorCpfSearchModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="collaboratorCpfSearchModalTitle">Colaborador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.show.collaborator.datac',$current_school_year)}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="cpfsearch">Cpf</label>
                        <input type="text" class="form-control rounded-borders" id="cpfsearch" name="cpfsearch" placeholder="CPF" required>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn button-orange rounded-borders">Pesquisar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Collaborator cpf search Modal -->
    
    <!-- Aluno Modal allStudents -->
    <div class="modal fade " id="alunoModal" tabindex="-1" role="dialog" aria-labelledby="alunoModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="alunoModalTitle">Aluno</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="row">
                    <div class=" col-md-12">
                        <label for="search">Nome</label><br>
                        <div class="form-search">
                            <input type="text" name="name_search" id="search" placeholder="Nome do aluno"  required>
                            <div class="resultado">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-md-12">
                        <a href="#" data-toggle="modal" data-target="#alunoCodigoModal">
                            <small>Pesquisar por código</small>
                        </a>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Aluno Modal -->

    <!-- allStudents Modal  -->
    <div class="modal fade " id="allStudentsModal" tabindex="-1" role="dialog" aria-labelledby="allStudentsModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="allStudentsModalTitle">Alunos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <a href="{{route('admin.all.students.sheet',['year'=>$current_school_year])}}">Exportar Planilha</a>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-12">
                        <a href="{{route('admin.all.students.data.sheet',['year'=>$current_school_year])}}">Exportar Planilha com todos os dados</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="painel-list">
                            <ul class="list-group">
                                <li class="painel-list-item bg-white ">
                                    <ul class="list-group painel-list-cel">
                                        <span class="badge painel-list-item-index">#</span>
                                        <li class="list-group-item painel-list-name-cel bg-white">Nome</li>
                                        <li class="list-group-item painel-list-cel-item bg-white">Data de Matrícula</li>
                                        <li class="list-group-item painel-list-cel-item bg-white">Turma</li>
                                    </ul>
                                </li>
                                @foreach($all_student_registers as $ar)
                                <a href="{{route('admin.show.student.data.byclass',['year'=>$current_school_year,'id'=>$ar->id,'class_id'=>$ar->institution_class_id])}}">
                                    <li class="painel-list-item bg-white ">
                                        <ul class="list-group painel-list-cel">
                                            <span class="badge painel-list-item-index">{{$all_registers_counter++}}</span>
                                            <li class="list-group-item painel-list-name-cel bg-white">{{$ar->name}}</li>
                                            <li class="list-group-item painel-list-cel-item bg-white">{{date("d/m/Y", strtotime($ar->enrollment_date))}}</li>
                                            <li class="list-group-item painel-list-cel-item bg-white">{{$ar->institution_class}}</li>
                                        </ul>
                                    </li>
                                </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM allStudents Modal -->

    <!-- Aluno Codigo Modal -->
    <div class="modal fade " id="alunoCodigoModal" tabindex="-1" role="dialog" aria-labelledby="alunoCodigoModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="alunoCodigoModalTitle">Aluno</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.show.student.datac',$current_school_year)}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputCodigoAluno">Código</label>
                        <input type="text" class="form-control rounded-borders" id="inputCodigoAluno" name="enrollment_code" placeholder="Código" required>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn button-orange rounded-borders">Pesquisar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Aluno Codigo Modal -->
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
            <form action="{{route('admin.store.student.waiting.list.submit',['year' => $current_school_year, 'page' => 'home'])}}" method="POST">
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
                        <select class="custom-select form-control  rounded-borders" name="institution_class_id" id="input_institution_class" required>
                            <option value="">Selecione</option>
                            @foreach($each_class_amount as &$c)
                                <option value="{{$c['id']}}">{{$c['institution_class']}}</option>
                            @endforeach
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
                            <hr>
                            <p><strong>{{$c['amount']}}</strong> Alunos</p>
                        </a>
                    </div>
                    @endforeach
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
    <!-- FIM Turmas Modal -->
    <!-- Nova Turma Modal -->
    <div class="modal fade " id="novaturmaModal" tabindex="-1" role="dialog" aria-labelledby="novaturmaModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="novaturmaModalTitle">Nova Turma</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.store.class.submit',$current_school_year)}}" method="POST">
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
                        <label>Ano Letivo</label>
                        <select class="custom-select form-control  rounded-borders" name="school_year_id" required readonly>
                            <option value="{{$school_year_id}}">{{$current_school_year}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputTurma">Turma</label>
                        <input type="text" class="form-control rounded-borders" name="institution_class" id="inputTurma" placeholder="Nome da Turma" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label id="max_amount_student">Quantidade Máxima de alunos</label>
                        <input type="number" min="1" class="form-control rounded-borders" name="max_amount_student" id="max_amount_student" placeholder="Quantidade" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="grade_id">Ano</label>
                        <select class="custom-select form-control  rounded-borders" name="grade_id" >
                            @foreach($grades as $grade)
                                <option value="{{$grade->id}}">{{$grade->grade}} - {{$grade->beginnig_age}} anos</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Nova Turma Modal -->
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
                    <div class="form-group col-md-3">
                        <label for="legal_responsable">Autorizar Uso de Imagem</label>
                        <select class="custom-select form-control  rounded-borders" id="auth_image_use" name="auth_image_use" required>
                            <option selected value="on">Sim</option>
                            <option value="off">Não</option>
                        </select>
                    </div>
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

    <!-- New Collaborator Modal -->
    <div class="modal fade " id="newCollaboratorModal" tabindex="-1" role="dialog" aria-labelledby="newCollaboratorModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newCollaboratorModalTitle">Novo Colaborador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.store.collaborator.maindata',$current_school_year)}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="institution_id">Instituição onde o colaborador será cadastrado</label>
                        <select class="custom-select form-control  rounded-borders" name="institution_id" readonly>
                            <option value="{{$online_collaborator_institution_id}}">{{$online_institution_name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control rounded-borders" id="cname" name="name" placeholder="Nome Completo do Colaborador" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="date_birth">Data de Nascimento</label>
                        <input type="date" class="form-control rounded-borders" id="cdate_birth" name="date_birth" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="place_birth">Naturalidade</label>
                        <input type="text" class="form-control rounded-borders" id="cplace_birth" name="place_birth" placeholder="Local de Nascimento-UF" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="gender_id">Gênero</label>
                        <select class="custom-select form-control rounded-borders" name="gender_id" required>
                            <option selected>Selecione o gênero</option>
                            @foreach($genders as $gender)
                                <option value="{{$gender->id}}">{{$gender->gender}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="collaborator_status">Status</label>
                        <select class="custom-select form-control rounded-borders" name="collaborator_status" required>
                            <option selected value="Active">Ativo</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="ccpf">CPF</label>
                        <input type="text" class="form-control rounded-borders" id="ccpf" name="cpf" placeholder="CPF" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rg">RG</label>
                        <input type="text" class="form-control rounded-borders" id="crg" name="rg" placeholder="RG" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rg_emissor">EMISSOR</label>
                        <input type="text" class="form-control rounded-borders" id="crg_emissor" name="rg_emissor" placeholder="Emissor" required>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Novo Colaborador Modal -->

    <!-- New Teacher Modal -->
    <div class="modal fade " id="newTeacherModal" tabindex="-1" role="dialog" aria-labelledby="newTeacherModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newTeacherModalTitle">Novo Professor - Dados de acesso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.store.teacher.accessdata.submit',$current_school_year)}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="collaborator_id">Identifique o(a) colaborador(a)</label>
                        <select class="custom-select form-control rounded-borders" name="collaborator_id" id="collaboratorid" required onchange="nameSelected()">
                            <option selected>Selecione um Colaborador</option>
                            @foreach($collaborators as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Nome do(a) professor(a)</label>
                        <input type="text"  class="form-control rounded-borders" name="name" id="selected_name"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control rounded-borders" id="email_collaborator" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control rounded-borders" id="password" name="password" placeholder="Senha" required>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Novo Teacher Modal -->
    
    

    <script>
        function nameSelected() {
            var select = document.getElementById('collaboratorid');
            var option = select.children[select.selectedIndex];
            var name = option.textContent;

            document.getElementById('selected_name').value = name;
        }
    </script>
@stop