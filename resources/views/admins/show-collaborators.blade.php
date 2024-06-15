@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-list">
                <h3 class="text-center">Colaboradores</h3>
                <br>
                <ul class="list-group">
                    <ul class="nav justify-content-center">
                      <li class="nav-item  menu-down-upon-content">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#newCollaboratorModal">Novo Colaborador</a>
                      </li>
                    </ul>
                    <li class="painel-list-item bg-orange text-white">
                        <ul class="list-group painel-list-cel ">
                            <span class="badge painel-list-item-index">#</span>
                            <li class="list-group-item painel-list-name-cel bg-transparent">Nome</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent">Data de Nascimento</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent">Telefone</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent">Telefone</li>
                        </ul>
                    </li>
                    @foreach($collaborators_data as $data)
                        <a href="{{route('admin.show.collaborator.data',[$current_school_year,$data->id])}}">
                            <li class="painel-list-item">
                                <ul class="list-group painel-list-cel">
                                    <span class="badge painel-list-item-index">{{$counter++}}</span>
                                    <li class="list-group-item  painel-list-name-cel">{{$data->name}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{date("d/m/Y", strtotime($data->date_birth))}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{$data->phone1}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{$data->phone2}}</li>
                                </ul>
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
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
@stop