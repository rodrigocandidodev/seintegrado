@extends('layouts/pages')

@section('conteudo')
    <div class="container">
      <div class="row">
        <div class="painel-grid rounded-borders">
          <div class="painel-box">
            <div class="painel-box-header">
                <h3>Configurações</h3>
                @if(Session::has('message'))
                    <div id="notification_tab" class="p-3 mb-2 bg-orange text-white text-center rounded-borders">{{ Session::get('message') }}</div>
                @endif
            </div>
            <hr>
            <div class="painel-box-body">
              <div class="row">
                <div class="col-md-4">
                  <h5>Instituição</h5>
                  <ul>
                    <li><a href="#" data-toggle="modal" data-target="#institutionModal">Informações</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#anoLetivoModal">Ano Letivo</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#schoolYearDivisionModal">Divisão do ano letivo</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#anosEscolaresModal">Anos Escolares</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#listdepartmentModal">Departamentos</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#listjobModal">Cargos</a></li>
                  </ul>
                </div>
                <div class="col-md-4">
                  <h5>Sistema</h5>
                  <ul>
                    <li><a href="#" data-toggle="modal" data-target="#adminsModal">Administradores</a></li>
                  </ul>
                </div>
                <div class="col-md-4">
                  <h5>Avaliação</h5>
                  <ul>
                    <li><a href="#" data-toggle="modal" data-target="#examTypesModal">Tipos de Avaliação</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Nome Modal-->
    <div class="modal fade " id="institutionModal" tabindex="-1" role="dialog" aria-labelledby="institutionModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="nomeInstituicaoModalTitle">Instituição</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.update.institution.data.submit',$current_school_year)}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="iname">Nome</label>
                        <input type="text" class="form-control rounded-borders" id="iname" name="name" placeholder="Nome Completo da Instituição" value="{{$all_online_institution_data['name']}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputinep">INEP</label>
                        <input type="text" class="form-control rounded-borders" id="inputinep" name="inep_number" placeholder="Número do INEP da Instituição" value="{{$all_online_institution_data['inep']}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputaddress">Endereço</label>
                        <input type="text" class="form-control rounded-borders" id="inputaddress" name="address" placeholder="Endereço da Instituição" value="{{$all_online_institution_data['address']}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputcity">Cidade</label>
                        <input type="text" class="form-control rounded-borders" id="inputcity" name="city" placeholder="Cidade" value="{{$all_online_institution_data['city']}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputstate">Estado</label>
                        <input type="text" class="form-control rounded-borders" id="inputstate" name="state" placeholder="Estado" value="{{$all_online_institution_data['state']}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputcnpj">CNPJ</label>
                        <input type="text" class="form-control rounded-borders" id="inputcnpj" name="cnpj" placeholder="CNPJ" value="{{$all_online_institution_data['cnpj']}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputphone">Telefone</label>
                        <input type="text" class="form-control rounded-borders" id="inputphone" name="phone" placeholder="Telefone" value="{{$all_online_institution_data['phone']}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputemail">E-mail</label>
                        <input type="text" class="form-control rounded-borders" id="inputemail" name="email" placeholder="E-mail" value="{{$all_online_institution_data['email']}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputmaintainer">Mantenedor</label>
                        <input type="text" class="form-control rounded-borders" id="inputmaintainer" name="maintainer" placeholder="Mantenedor" value="{{$all_online_institution_data['maintainer']}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputmotto">Lema</label>
                        <input type="text" class="form-control rounded-borders" id="inputmotto" name="motto" placeholder="Lema" value="{{$all_online_institution_data['motto']}}">
                    </div>
                </div>
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn button-orange rounded-borders">Salvar Alterações</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Nome Modal-->

    <!-- Anos Escolares Modal -->
    <div class="modal fade " id="anosEscolaresModal" tabindex="-1" role="dialog" aria-labelledby="anosEscolaresModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="anosEscolaresModalTitle">Anos Escolares</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-12 text-center">
                        @for($i=0;$i<$institution_classes_length; $i++)
                            <a href="#">
                                <div class="modal-menu-lista rounded-borders col-md-2 bg-white outline">
                                    <h6 class="p-2 text-dark " href="#">{{$all_institution_grades[$i]}}</h6>
                                </div>
                            </a>
                        @endfor
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

    
    
    <!-- list department Modal -->
    <div class="modal fade " id="listdepartmentModal" tabindex="-1" role="dialog" aria-labelledby="listdepartmentModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="listdepartmentModalTitle">Departamentos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <a href="#" data-toggle="modal" data-target="#newdepartmentModal">Novo Departamento</a>
                        <br>
                        <a href="#" data-toggle="modal" data-target="#selectdepartmentModal">Editar Departamento</a>
                        <br>
                        <a href="#" data-toggle="modal" data-target="#deleteselectdepartmentModal">Eliminar Departamento</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        @foreach($departments as $data)
                            <p>{{$data->department}}</p>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM list department job Modal -->
    <!-- new department Modal -->
    <div class="modal fade " id="newdepartmentModal"  tabindex="-1" role="dialog" aria-labelledby="newDepartmentModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newDepartmentModalTitle">Novo Departamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.store.department.submit',$current_school_year)}}" method="POST">
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
                        <label>Departamento</label>
                        <input type="text" class="form-control rounded-borders" name="department" placeholder="Departamento" required>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM new department Modal -->
    <!-- select department Modal -->
    <div class="modal fade " id="selectdepartmentModal" tabindex="-1" role="dialog" aria-labelledby="selectdepartmentModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="selectdepartmentModalTitle">Departamentos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <p>Selecione o departamento que deseja editar</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        @foreach($departments as $data)
                            <a href="#" data-toggle="modal" data-target="#updatedepartmentModal{{$data->id}}"><h5 class="p-2" >{{$data->department}}</h5></a>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM select department job Modal -->
    <!-- delete select department Modal -->
    <div class="modal fade " id="deleteselectdepartmentModal" tabindex="-1" role="dialog" aria-labelledby="deleteselectdepartmentModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteselectdepartmentModalTitle">Departamentos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <p>Selecione o departamento que deseja eliminar</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        @foreach($departments as $data)
                            <a href="#" data-toggle="modal" data-target="#deletedepartmentModal{{$data->id}}"><h5 class="p-2" >{{$data->department}}</h5></a>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM delete select department job Modal -->
    <!-- update and delete department Modal -->
    @foreach($departments as $data)
        <div class="modal fade " id="updatedepartmentModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="departmentModalTitle{{$data->id}}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="departmentModalTitle{{$data->id}}">Editar Departamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('admin.update.department.submit',$current_school_year)}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Instituição</label>
                            <select class="custom-select form-control rounded-borders" name="institution_id" readonly>
                                <option value="{{$online_collaborator_institution_id}}">{{$online_institution_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Departamento</label>
                            <input type="text" class="form-control rounded-borders" name="department" value="{{$data->department}}" required>
                            <input type="hidden" name="id" value="{{$data->id}}">
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade " id="deletedepartmentModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="deletedepartmentModalTitle{{$data->id}}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deletedepartmentModalTitle{{$data->id}}">Eliminar Departamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <p>Deseja realmente eliminar este departamento? Todos os cargos vinculados a este departamento serão eliminados.</p>
                        <p>Antes de eliminar, tenha certeza se todos os colaboradores que estavam vinculados a este departamento estão cadastrados em outro!</p>
                        <p>Não será possível desfazer esta operação!</p>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    <a href="{{route('admin.delete.department',[$current_school_year,$data->id])}}"><button type="button" class="btn button-orange rounded-borders">Eliminar</button></a>
              </div>
            </div>
          </div>
        </div>
    @endforeach
    <!-- FIM update and delete department Modal -->
    
    <!-- list job Modal -->
    <div class="modal fade " id="listjobModal" tabindex="-1" role="dialog" aria-labelledby="listjobModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="listjobModalTitle">Cargos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <a href="#" data-toggle="modal" data-target="#jobModal">Novo Cargo</a>
                        <br>
                        <a href="#" data-toggle="modal" data-target="#selectjobModal">Editar Cargo</a>
                        <br>
                        <a href="#" data-toggle="modal" data-target="#selectdeletejobModal">Eliminar Cargo</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        @foreach($jobs as $data)
                            <p>{{$data->office}}</p>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM list job Modal -->
     <!-- select update job Modal -->
    <div class="modal fade " id="selectjobModal" tabindex="-1" role="dialog" aria-labelledby="selectjobModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="selectjobModalTitle">Cargos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <p>Selecione o Cargo que deseja editar</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        @foreach($jobs as $data)
                            <a href="#" data-toggle="modal" data-target="#updatejobModal{{$data->id}}"><p>{{$data->office}}</p></a>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM select update job Modal -->
    <!-- select delete job Modal -->
    <div class="modal fade " id="selectdeletejobModal" tabindex="-1" role="dialog" aria-labelledby="selectdeletejobModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="selectdeletejobModalTitle">Eliminar Cargo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <p>Selecione o Cargo que deseja eliminar</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        @foreach($jobs as $data)
                            <a href="#" data-toggle="modal" data-target="#deletejobModal{{$data->id}}"><p>{{$data->office}}</p></a>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM select delete job Modal -->
    <!-- job Modal -->
    <div class="modal fade " id="jobModal" tabindex="-1" role="dialog" aria-labelledby="jobModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="jobModalTitle">Novo Cargo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.store.job.submit',$current_school_year)}}" method="POST">
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
                        <label for="department_id">Departamento</label>
                        <select class="custom-select form-control  rounded-borders" name="department_id">
                            @foreach($departments as $data)
                                <option value="{{$data->id}}">{{$data->department}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Cargo</label>
                        <input type="text" class="form-control rounded-borders" name="office" placeholder="Cargo" required>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM job Modal -->
    @foreach($jobs as $data)
        <div class="modal fade " id="updatejobModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="departmentModalTitle{{$data->id}}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="updatejobModalTitle{{$data->id}}">Editar Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('admin.update.job.submit',[$current_school_year,$data->id])}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Instituição</label>
                            <select class="custom-select form-control rounded-borders" name="institution_id" readonly>
                                <option value="{{$online_collaborator_institution_id}}">{{$online_institution_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Departamento</label>
                            <select class="custom-select form-control  rounded-borders" name="department_id">
                                <option selected value="{{$data->department_id}}">{{$data->department}}</option>
                                @foreach($departments as $ddata)
                                    @if($data->department != $ddata->department)
                                        <option value="{{$ddata->id}}">{{$ddata->department}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Cargo</label>
                            <input type="text" class="form-control rounded-borders" name="office" value="{{$data->office}}" required>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade " id="deletejobModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="deletejobModalTitle{{$data->id}}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deletejobModalTitle{{$data->id}}">Eliminar Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <p>Deseja realmente eliminar este Cargo?</p>
                        <p>Antes de eliminar, tenha certeza se todos os colaboradores que estavam vinculados a este cargo estão cadastrados em outro!</p>
                        <p>Não será possível desfazer esta operação!</p>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    <a href="{{route('admin.delete.job',[$current_school_year,$data->id])}}"><button type="button" class="btn button-orange rounded-borders">Eliminar</button></a>
              </div>
            </div>
          </div>
        </div>
    @endforeach

    <!-- Admins Modal -->
    <div class="modal fade " id="adminsModal" tabindex="-1" role="dialog" aria-labelledby="adminsModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="adminsModalTitle">Administradores</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row text-center">
              <div class="col-md-12">
                  <a href="#" data-toggle="modal" data-target="#newAdminModal">Novo Administrador</a>
                  <br>
                  <a href="#" data-toggle="modal" data-target="#removeAdminModal">Remover Administador</a>
                  <br>
                  <a href="#" data-toggle="modal" data-target="#reAddAdminModal">Restaurar Administador</a>
              </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                    @foreach($all_admins as $aa)
                        <p>{{$aa->name}}</p>
                    @endforeach
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Admins Modal -->

    @if($admin_type_data == 'Coordination')
        <!-- Exam Types Modal -->
        <div class="modal fade " id="examTypesModal" tabindex="-1" role="dialog" aria-labelledby="examTypesModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="examTypesModalTitle">Tipos de Avaliação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        @foreach($exam_types as $et)
                            <a class="text-muted" href="#">
                                <div class="menu-lista text-center bg-white pl-2 pr-2 rounded-borders">
                                    <span class="mt-2">{{$et->exam_type}}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    @endif
    

    <!-- new admin Modal -->
    <div class="modal fade " id="newAdminModal"  tabindex="-1" role="dialog" aria-labelledby="newAdminModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newAdminModalTitle">Novo Administrador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.store.admin.submit',$current_school_year)}}" method="POST">
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
                        <label for="collaborator_id">Colaborador</label>
                        <select class="custom-select form-control  rounded-borders" name="collaborator_id" required>
                          @foreach($active_collaborators as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="adminname">Nome de Administrador</label>
                        <input type="text" class="form-control rounded-borders" name="name" id="adminname" placeholder="Nome de Administrador" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="admintype">Tipo de Administrador</label>
                        <select class="custom-select form-control  rounded-borders" name="admin_type_id" required>
                          @foreach($all_admin_types as $aat)
                            <option value="{{$aat->id}}">{{$aat->admin_type}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="adminemail">E-mail</label>
                        <input type="email" class="form-control rounded-borders" name="email" id="adminemail" placeholder="E-mail" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="adminpassword">Senha</label>
                        <input type="password" class="form-control rounded-borders" name="password" id="adminpassword" placeholder="Senha" required>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM new admin Modal -->

    <!-- Remove Admins Modal -->
    <div class="modal fade " id="removeAdminModal" tabindex="-1" role="dialog" aria-labelledby="removeAdminModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="removeAdminModalTitle">Remover Administrador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>Selecione o Administrador que deseja remover</p>
                </div>
                <hr>
                <div class="col-md-12 mb-3 text-center">
                    @foreach($all_admins as $aa)
                        <a href="{{route('admin.remove.admin',['year'=>$current_school_year, 'id' => $aa->id])}}"><p>{{$aa->name}}</p></a>
                    @endforeach
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Remove Admins Modal -->

    <!-- Readd Admins Modal -->
    <div class="modal fade " id="reAddAdminModal" tabindex="-1" role="dialog" aria-labelledby="reAddAdminModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="reAddAdminModalTitle">Restaurar Administrador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>Selecione o Administrador que deseja restaurar</p>
                </div>
                <hr>
                <div class="col-md-12 mb-3 text-center">
                    @foreach($all_inactiveadmins as $aia)
                        <a href="{{route('admin.readd.admin',['year'=>$current_school_year, 'id' => $aia->id])}}"><p>{{$aia->name}}</p></a>
                    @endforeach
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END Readd Admins Modal -->

    <!-- school year divisions Modal -->
    <div class="modal fade " id="schoolYearDivisionModal" tabindex="-1" role="dialog" aria-labelledby="schoolYearDivisionModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="schoolYearDivisionModalTitle">Divisão do ano letivo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <a href="#" data-toggle="modal" data-target="#newSchoolYearDivisionModal">Nova Divisão</a>
                        <br>
                        <a href="#" data-toggle="modal" data-target="#selectSchoolYearDivisionModal">Editar Divisão</a>
                        <br>
                        <a href="#" data-toggle="modal" data-target="#deleteSelectSchoolYearDivisionModal">Eliminar Divisão</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        @foreach($school_year_divisions as $data)
                            <p>{{$data->division}}</p>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END school year divisions Modal -->

    <!-- select delete school year divisions Modal -->
    <div class="modal fade " id="deleteSelectSchoolYearDivisionModal" tabindex="-1" role="dialog" aria-labelledby="deleteSelectSchoolYearDivisionModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteSelectSchoolYearDivisionModalTitle">Eliminar Divisão</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <p>Selecione a divisão que deseja eliminar</p>
                        <p>ATENÇÃO: a exclusão de um bimestre poderá afetar outros dados vinculados a este, por exemplo: avaliações e frequência escolar. Tenha certeza do que está fazendo. Esta operação só terá sucesso se todos os vínculos desta divisão estiverem sido desfeitas antes. Uma alternativa é a edição do mesmo.</p>
                        <a href="#" data-toggle="modal" data-target="#selectSchoolYearDivisionModal"><p>Editar</p></a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        @foreach($school_year_divisions as $data)
                            <a href="{{route('admin.delete.school-year.division.submit',['year' => $current_school_year, 'id' => $data->id])}}"><p>{{$data->division}}</p></a>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM select delete school year divisions Modal -->

    <!-- select update school year division Modal -->
    <div class="modal fade " id="selectSchoolYearDivisionModal" tabindex="-1" role="dialog" aria-labelledby="selectSchoolYearDivisionModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="selectSchoolYearDivisionModalTitle">Divisões</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <p>Selecione a divisão que deseja editar</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        @foreach($school_year_divisions as $data)
                            <a href="#" data-toggle="modal" data-target="#updateSchoolYearDivisionModal{{$data->id}}"><p>{{$data->division}}</p></a>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- FIM select update school year division Modal -->

    @foreach($school_year_divisions as $data)
        <div class="modal fade " id="updateSchoolYearDivisionModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="updateSchoolYearDivisionModalTitle{{$data->id}}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="updateSchoolYearDivisionModalTitle{{$data->id}}">Divisão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('admin.update.school-year.division.submit',['year' => $current_school_year,'id' => $data->id])}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Divisão</label>
                            <input type="text" class="form-control rounded-borders" name="division" value="{{$data->division}}" required>
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

    <div class="modal fade " id="newSchoolYearDivisionModal" tabindex="-1" role="dialog" aria-labelledby="newSchoolYearDivisionModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="newSchoolYearDivisionModalTitle">Nova Divisão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('admin.store.school-year.division.submit',[$current_school_year,$data->id])}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Instituição</label>
                            <select class="custom-select form-control rounded-borders" name="institution_id" readonly>
                                <option value="{{$online_collaborator_institution_id}}">{{$online_institution_name}}</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Divisão</label>
                            <input type="text" class="form-control rounded-borders" name="division" placeholder="Nome da Divisão" required>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
@stop