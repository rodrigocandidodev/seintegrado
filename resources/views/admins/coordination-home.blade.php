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
    @if(Session::has('message'))
        <div class="p-3 mb-2 bg-orange text-white text-center rounded-borders" id="notification_tab">{{ Session::get('message') }}</div>
    @endif
    <!--GRID-MENU-->
    <div class="container">
        <div class="row">
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
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#collaboratorModal">
                    <h1 class="margin-top-10">Cb</h1>
                    <p>Colaborador</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="{!! route('admin.config', $current_school_year); !!}">
                    <h1 class="margin-top-10">Cf</h1>
                    <p>Configurações</p>
                </a>
            </div>
        </div>
        <div class="row">
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
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#classSchedulesModal" title="Horário de Aula">
                    <h1 class="margin-top-10">Hr</h1>
                    <p>Horário de Aula</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#examsModal" title="Horário de Avaliações">
                    <h1 class="margin-top-10">HA</h1>
                    <p>Horário de Avaliações</p>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#listCurricularComponentModal" title="Componentes Curriculares">
                    <h1 class="margin-top-10">Cm</h1>
                    <p>Componentes</p>
                </a>
            </div>
        	<div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="{{ route('admin.plan.home',$current_school_year)}}" title="Grupos de Planejamentos Diários">
                    <h1 class="margin-top-10">Gr</h1>
                    <p>Grupos</p>
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
                            <input type="text" name="name_search" id="search" placeholder="Nome do aluno" required>
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
                            <p>{{$c['amount']}} Alunos</p>
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

    <!-- list Curricular Component Modal -->
    <div class="modal fade " id="listCurricularComponentModal" tabindex="-1" role="dialog" aria-labelledby="listCurricularComponentModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="listCurricularComponentModalTitle">Componentes Curriculares</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <a href="#" data-toggle="modal" data-target="#newCurricularComponentModal">Nova Componente Curricular</a>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-12">
                        <a href="#" data-toggle="modal" data-target="#TotalHoursModal">Cargas horárias</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($all_curricular_components as $acc)
                    <div class="inline-list-rectangles text-center bg-white">
                        <a class="text-muted" href="#">
                            <h5 class="margin-top-10">{{$acc->component}}</h5>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- FIM list department job Modal -->

<!-- New Curricular Component Modal -->
    <div class="modal fade " id="newCurricularComponentModal" tabindex="-1" role="dialog" aria-labelledby="newCurricularComponentModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newCurricularComponentModalTitle">Novo Componente Curricular</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.store.curricular.component', $current_school_year)}}" method="POST">
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
                        <input type="text"  class="form-control rounded-borders" name="year" placeholder="Ano Letivo" value="{{$current_school_year}}" readonly />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Área do Conhecimento</label>
                        <select class="custom-select form-control  rounded-borders" name="knowledge_area_id" required>
                            <option value="">Selecione</option>
                            @foreach($knowledge_areas as $ka)
                                <option value="{{$ka->id}}">{{$ka->knowledge_area}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputCurricularComponent">Componente Curricular</label>
                        <input type="text"  class="form-control rounded-borders" name="component" id="inputCurricularComponent" placeholder="Componente Curricular" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputAbbreviation">Abreviação Componente Curricular</label>
                        <input type="text"  class="form-control rounded-borders" name="abbreviation" id="inputAbbreviation" placeholder="Abreviação de 2 ou 4 caracteres" min="2" max="4" />
                    </div>
                </div>

                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Novo Curricular Component Modal -->

    <!-- Exams Calendar Modal -->
    <div class="modal fade " id="examsModal" tabindex="-1" role="dialog" aria-labelledby="examsModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="examsModalTitle">Horário de Avaliações</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row text-center">
                <div class="col-md-12">
                    <a href="#" data-toggle="modal" data-target="#newExamDateModal">Cadastrar nova Avaliação</a>
                </div>
            </div>
            <hr>
            <div class="row">
            @foreach($exams as $e)
                <div class="menu-lista text-center bg-white pl-2 pr-2 rounded-borders">
                    <a class="text-muted" href="#" data-toggle="modal" data-target="#exam{{$e->id}}">
                        <strong>{{date('d/m', strtotime($e->exam_date))}}</strong> - <span class="mt-2">{{$e->exam}}</span>
                    </a>
                </div>
            @endforeach
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- ENDING Modal -->

    <!-- NEW Exams Date Modal -->
    <div class="modal fade " id="newExamDateModal" tabindex="-1" role="dialog" aria-labelledby="newExamDateModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newExamDateModalTitle">Cadastrar nova avaliação</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.store.exam.submit', $current_school_year)}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputexamtitle">Título</label>
                        <input type="text" class="form-control rounded-borders" name="exam" id="inputexamtitle" placeholder="Título da avaliação"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputexamdate">Data</label>
                        <input type="date" class="form-control rounded-borders" name="exam_date" id="inputexamdate" title="Data da avaliação"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputvaluetitle">Valor</label>
                        <input type="number" step="0.1" class="form-control rounded-borders" name="value" id="inputvaluetitle" placeholder="Valor da avaliação"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCurricularComponent">Componente Curricular</label>
                        <select class="custom-select form-control  rounded-borders" name="curricular_component_id" required>
                            <option value="">Selecione</option>
                            @foreach($all_curricular_components as $cc)
                                <option value="{{$cc->id}}">{{$cc->component}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputDivision">Divisão</label>
                        <select class="custom-select form-control  rounded-borders" id="inputDivision" name="division_id" required>
                            <option value="">Selecione</option>
                            @foreach($divisions as $d)
                                <option value="{{$d->id}}">{{$d->division}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputexamtype">Tipo de Avaliação</label>
                        <select class="custom-select form-control  rounded-borders" id="inputexamtype" name="exam_type_id" required>
                            <option value="">Selecione</option>
                            @foreach($exam_types as $et)
                                <option value="{{$et->id}}">{{$et->exam_type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputClass">Turma</label>
                        <select class="custom-select form-control  rounded-borders" id="inputClass" name="institution_class_id" required>
                            <option value="">Selecione</option>
                            @foreach($each_class_amount as &$c)
                                <option value="{{$c['id']}}">{{$c['institution_class']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- ENDING Modal -->

    @foreach($exams as $e)
    <!-- NEW  Exams Modal -->
    <div class="modal fade " id="exam{{$e->id}}" tabindex="-1" role="dialog" aria-labelledby="exam{{$e->id}}ModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exam{{$e->id}}ModalTitle">Avaliação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="profile-inline-list-rectangles text-center bg-orange">
                            <a class="text-white" href="#" data-toggle="modal" data-target="#EditExam{{$e->id}}">Editar</a>
                        </div>

                        <div class="profile-inline-list-rectangles text-center bg-orange">
                            <a class="text-white" href="{{route('admin.delete.exam',['year' => $current_school_year, 'id' => $e->id])}}">Eliminar</a>
                        </div>

                        <div class="profile-inline-list-rectangles text-center bg-orange">
                            <a class="text-white" href="{{route('admin.exams.results',['year' => $current_school_year, 'id' => $e->id])}}">Resultados</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <small>Título</small>
                            <h4>{{$e->exam}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <small>Tipo de Avaliação</small>
                            <h4>{{$e->exam_type}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <small>Data</small>
                            <h4>{{date('d/m/Y',strtotime($e->exam_date))}}</h4>
                        </div>
                        <div class="col-md-6">
                            <small>Valor</small>
                            <h4>{{$e->value}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <small>Professor (a)</small>
                            <h4>{{$e->name}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <small>Componente Curricular</small>
                            <h4>{{$e->component}}</h4>
                        </div>
                    </div>
              </div>
            </div>
        </div>
    </div>
    <!-- NEW Exams Date Modal -->
    <div class="modal fade " id="EditExam{{$e->id}}" tabindex="-1" role="dialog" aria-labelledby="EditExam{{$e->id}}ModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="EditExam{{$e->id}}ModalTitle">Editar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.update.exam.submit', [
                'year' => $current_school_year,
                'id'   => $e->id
            ])}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputexamtitle{{$e->id}}">Título</label>
                        <input type="text" class="form-control rounded-borders" name="exam" id="inputexamtitle{{$e->id}}" placeholder="Título da avaliação" value="{{$e->exam}}" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputexamdate{{$e->id}}">Data</label>
                        <input type="date" class="form-control rounded-borders" name="exam_date" id="inputexamdate{{$e->id}}" title="Data da avaliação" value="{{$e->exam_date}}"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputvaluetitle{{$e->id}}">Valor</label>
                        <input type="number" step="0.1" class="form-control rounded-borders" name="value" id="inputvaluetitle{{$e->id}}" placeholder="Valor da avaliação" value="{{$e->value}}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCurricularComponent{{$e->id}}">Componente Curricular</label>
                        <select class="custom-select form-control  rounded-borders" name="curricular_component_id{{$e->id}}" required>
                            <option value="{{$e->curricular_component_id}}">{{$e->component}}</option>
                            @foreach($all_curricular_components as $cc)
                                @if($e->curricular_component_id != $cc->id)
                                    <option value="{{$cc->id}}">{{$cc->component}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputDivision{{$e->id}}">Divisão</label>
                        <select class="custom-select form-control  rounded-borders" id="inputDivision{{$e->id}}" name="division_id" required>
                            <option value="{{$e->division_id}}">{{$e->division}}</option>
                            @foreach($divisions as $d)
                                @if($e->division_id != $d->id)
                                    <option value="{{$d->id}}">{{$d->division}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputClass{{$e->id}}">Turma</label>
                        <select class="custom-select form-control  rounded-borders" id="inputClass{{$e->id}}" name="institution_class_id" required>
                            <option value="{{$e->institution_class_id}}">{{$e->institution_class}}</option>
                            @foreach($each_class_amount as &$c)
                                @if($e->institution_class_id != $c['id'])
                                    <option value="{{$c['id']}}">{{$c['institution_class']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- ENDING Modal -->
    @endforeach
    <!-- ENDING Modal -->

    <!-- Class Schedules Modal -->
    <div class="modal fade " id="classSchedulesModal" tabindex="-1" role="dialog" aria-labelledby="classSchedulesModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="classSchedulesModalTitle">Horários de aula</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row text-center">
                <div class="col-md-12">
                    <a href="#" data-toggle="modal" data-target="#newClassScheduleModal">Cadastrar</a>
                </div>
            </div>
            <hr>
            <div class="row">
                @foreach($each_class_amount as &$c)
                    <div class="inline-list-rectangles text-center bg-white">
                        <a class="text-muted" href="#" data-toggle="modal" data-target="#classSchedules{{$c['id']}}Modal">
                            <h5 class="margin-top-10">{{$c['institution_class']}}</h5>
                        </a>
                    </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ENDING Modal -->
    @foreach($schedules_by_class as $sbc)
        <!-- Class Schedules Modal -->
        <div class="modal fade " id="classSchedules{{$sbc->institution_class_id}}Modal" tabindex="-1" role="dialog" aria-labelledby="classSchedulesModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="classSchedulesModalTitle">Horário de aula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <a href="{{route('admin.export.sheet.class.schedule',[
                            'year'                  => $current_school_year,
                            'institution_class_id'  => $sbc->institution_class_id
                        ])}}">Exportar Planilha</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @for($i=0;$i<5;$i++)
                        <div class="inline-list-rectangles-250 text-center bg-white">
                            @if(($i==0))
                                <p>Segunda-feira</p>
                            @else
                                @if(($i==1))
                                    <p>Terça-feira</p>
                                @else
                                    @if(($i==2))
                                        <p>Quarta-feira</p>
                                    @else
                                        @if(($i==3))
                                            <p>Quinta-feira</p>
                                        @else
                                            @if(($i==4))
                                                <p>Sexta-feira</p>
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            @endif
                            @foreach($schedule[$sbc->institution_class_id] as $data)
                                @if($data->week_day == ($i+1))
                                    <span><a class="text-muted" href="#">{{$data->hour.' - '.$data->component}}</a></span>
                                    <br>
                                @endif
                            @endforeach
                        </div>
                    @endfor
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ENDING Modal -->
    @endforeach
    

    <!-- NEW Class Schedule Modal -->
    <div class="modal fade " id="newClassScheduleModal" tabindex="-1" role="dialog" aria-labelledby="newClassScheduleModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newClassScheduleModalTitle">Cadastrar horário de aula</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.store.class.schedule.submit', $current_school_year)}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="institution_id">Instituição</label>
                        <select class="custom-select form-control  rounded-borders" name="institution_id" readonly required>
                            <option value="{{$online_collaborator_institution_id}}">{{$online_institution_name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Ano Letivo</label>
                        <select class="custom-select form-control  rounded-borders" name="school_year_id" readonly required>
                            <option value="{{$school_year_id}}">{{$current_school_year}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_hour">Horário</label>
                        <input type="time" class="form-control rounded-borders" name="hour" id="input_hour" title="Horário da aula" required/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Dia da Semana</label>
                        <select class="custom-select form-control  rounded-borders" name="week_day" required>
                            <option value="">Selecione</option>
                            <option value="1">Segunda-feira</option>
                            <option value="2">Terça-feira</option>
                            <option value="3">Quarta-feira</option>
                            <option value="4">Quinta-feira</option>
                            <option value="5">Sexta-feira</option>
                            <option value="6">Sábado</option>
                            <option value="0">Domingo</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Turma</label>
                        <select class="custom-select form-control  rounded-borders" name="institution_class_id" required>
                            <option value="">Selecione</option>
                            @foreach($each_class_amount as &$c)
                                <option value="{{$c['id']}}">{{$c['institution_class']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputCurricularComponent">Componente Curricular</label>
                        <select class="custom-select form-control  rounded-borders" name="curricular_component_id" required>
                            <option value="">Selecione</option>
                            @foreach($all_curricular_components as $cc)
                                <option value="{{$cc->id}}">{{$cc->component}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_sequence">Sequência da aula</label>
                        <select class="custom-select form-control  rounded-borders" id="input_sequence" name="sequence" required>
                            <option value="">Selecione</option>
                            <option value="1">1ª aula</option>
                            <option value="2">2ª aula</option>
                            <option value="3">3ª aula</option>
                            <option value="4">4ª aula</option>
                            <option value="5">5ª aula</option>
                            <option value="6">6ª aula</option>
                            <option value="7">7ª aula</option>
                        </select>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- ENDING Modal -->

    <!-- Total hours Modal -->
    <div class="modal fade " id="TotalHoursModal" tabindex="-1" role="dialog" aria-labelledby="TotalHoursModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="TotalHoursModalTitle">Cargas Horárias</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <a href="#" data-toggle="modal" data-target="#newTotalHoursModal">Cadastrar nova Carga horária</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th scope="col">Ações</th>
                              <th scope="col">Componente Curricular</th>
                              <th scope="col">Carga Horária</th>
                              <th scope="col">Ano Escolar</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($previsions as $prev)
                                <tr>
                                  <th scope="row"><a href="{{route('admin.config.prevision.setup.delete',['year'=>$current_school_year,'id'=>$prev->id])}}">X</a></th>
                                  <td>{{$prev->component}}</td>
                                  <td>{{$prev->total_hours}}</td>
                                  <td>{{$prev->grade}}</td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
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
    <!-- FIM Anos Escolares Modal -->

    <!-- new total hours Modal -->
    <div class="modal fade " id="newTotalHoursModal"  tabindex="-1" role="dialog" aria-labelledby="newTotalHoursModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newDepartmentModalTitle">Nova Carga Horária</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.config.prevision.setup',$current_school_year)}}" method="POST">
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
                        <select class="custom-select form-control rounded-borders" name="year" readonly>
                            <option value="{{$current_school_year}}">{{$current_school_year}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="componentTotalHours">Componente Curricular</label>
                        <select class="custom-select form-control  rounded-borders" id="componentTotalHours" name="curricular_component_id" >
                            <option>Selecione uma componente</option>
                            @foreach($all_curricular_components as $data)
                                <option value="{{$data->id}}">{{$data->component}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="GradeTotalHours">Ano Escolar</label>
                        <select class="custom-select form-control  rounded-borders" id="GradeTotalHours" name="grade_id">
                            <option>Selecione um ano escolar</option>
                            @for($i=0;$i<$institution_classes_length; $i++)
                                <option value="{{$all_institution_grades_id[$i]}}">{{$all_institution_grades[$i]}}</option>
                            @endfor
                        </select>
                    </div> 
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Carga Horária</label>
                        <input type="number" class="form-control rounded-borders" name="total_hours" placeholder="Carga Horária" required>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM new total hours Modal -->

    <script>
        function nameSelected() {
            var select = document.getElementById('collaboratorid');
            var option = select.children[select.selectedIndex];
            var name = option.textContent;

            document.getElementById('selected_name').value = name;
        }
    </script>
@stop