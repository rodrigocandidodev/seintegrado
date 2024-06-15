@extends('layouts/pages')

@section('conteudo')
<div class="row">
    <div class="col-md-12 profile-banner">
        <div class="col-md-12 text-center">
            <strong><h1 class="text-white text-uppercase margin-top-100">{{$collaborator_data->name}}</strong></h1>
        </div>
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-white rounded-borders" data-toggle="modal" data-target="#editDataModal">Editar Dados</button>
        </div>
        <div class="col-md-12 text-center">
            <a class="text-white" href="{{route('admin.show.collaborators',$current_school_year)}}"><small>Ver todos os colaboradores</small></a>
        </div>

    </div>
</div>
<div class="container margin-top-10 padding-bottom-10 bg-white box-shadow-set rounded-borders-10 profile-contents">
    <div class="row categories-box">
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Dados Pessoais</strong></h5>

            <strong>Data de Nascimento</strong><br>
            <span>{{date("d/m/Y", strtotime($collaborator_data->date_birth))}}</span><br>

            <strong>Naturalidade</strong><br>
            <span>{{$collaborator_data->place_birth}}</span><br>

            <strong>CPF</strong><br>
            <span>{{$collaborator_data->cpf}}</span><br>

            <strong>RG</strong><br>
            <span>{{$collaborator_data->rg .' - ' . $collaborator_data->rg_emissor}}</span><br>
        </div>
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Contato</strong></h5>
            <strong>Telefone 1</strong><br>
            <span>{{$collaborator_data->phone1}}</span><br>

            <strong>Telefone 2</strong><br>
            <span>{{$collaborator_data->phone2}}</span><br>
        </div>
    </div>
    <div class="row categories-box">
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Endereço</strong></h5>
            <strong>Rua</strong><br>
            <span>{{$collaborator_data->street}}</span><br>

            <strong>Quadra</strong><br>
            <span>{{$collaborator_data->block}}</span><br>

            <strong>Lote</strong><br>
            <span>{{$collaborator_data->land_lot}}</span><br>
        </div>
        <div class="col-md-6 categories">
            <strong>Número</strong><br>
            <span>{{$collaborator_data->number}}</span><br>

            <strong>Bairro</strong><br>
            <span>{{$collaborator_data->neighborhood}}</span><br>

            <strong>CEP</strong><br>
            <span>{{$collaborator_data->zipcode}}</span><br>

            <strong>Complemento</strong><br>
            <span>{{$collaborator_data->complement}}</span><br>
        </div>
    </div>
    <div class="row categories-box">
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Trabalho</strong></h5>
            <strong>Cargo</strong><br>
            <span>{{$collaborator_data->office}}</span><br>
        </div>
        <div class="col-md-6 categories">
            <h5 class="text-uppercase"><strong>Escolaridade</strong></h5>
            <strong>Grau de escolaridade</strong><br>
            <span>{{$collaborator_data->scholarity}}</span><br>
        </div>
    </div>
</div>
<!--MODALS-->
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
                    <a href="#" data-toggle="modal" data-target="#CollaboratorUpdateModal">
                        <div class="modal-menu-lista rounded-borders col-md-3 bg-white outline">
                            <span class="p-2 text-dark">Dados</span>
                        </div>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#CollaboratorUpdateAddressModal">
                        <div class="modal-menu-lista rounded-borders col-md-3 bg-white outline">
                            <span class="p-2 text-dark">Endereço</span>
                        </div>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#CollaboratorUpdateScholarityModal">
                        <div class="modal-menu-lista rounded-borders col-md-3 bg-white outline">
                            <span class="p-2 text-dark">Escolaridade</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-12">
                    <a href="#" data-toggle="modal" data-target="#CollaboratorUpdateContactModal">
                        <div class="modal-menu-lista rounded-borders col-md-3 bg-white outline">
                            <span class="p-2 text-dark">Contato</span>
                        </div>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#CollaboratorUpdateJobModal">
                        <div class="modal-menu-lista rounded-borders col-md-3 bg-white outline">
                            <span class="p-2 text-dark">Trabalho</span>
                        </div>
                    </a>
                </div>
            </div>
            <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- FINISH Edit Data Modal -->
<!-- Collaborator Update Modal -->
<div class="modal fade " id="CollaboratorUpdateModal" tabindex="-1" role="dialog" aria-labelledby="CollaboratorUpdateModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="CollaboratorUpdateModalTitle">Atualizar Dados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.update.collaborator',[
                'year'              => $current_school_year,
                'collaborator_id'   => $collaborator_data->id
            ])}}" method="POST">
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
                        <input type="text" class="form-control rounded-borders" id="name" name="name" placeholder="Nome Completo" value="{{$collaborator_data->name}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="date_birth">Data de Nascimento</label>
                        <input type="date" class="form-control rounded-borders" id="date_birth" name="date_birth" value="{{$collaborator_data->date_birth}}">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>CPF (sem pontos e traços)</label>
                        <input type="text" class="form-control rounded-borders" name="cpf" placeholder="CPF" value="{{$collaborator_data->cpf}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="rg">RG</label>
                        <input type="text" class="form-control rounded-borders" id="rg" name="rg" placeholder="RG" value="{{$collaborator_data->rg}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="rg_emissor">Emissor</label>
                        <input type="text" class="form-control rounded-borders" id="rg_emissor" name="rg_emissor" placeholder="Emissor" value="{{$collaborator_data->rg_emissor}}">
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn button-orange rounded-borders">Atualizar</button>
            </form>
      </div>
    </div>
  </div>
</div>
<!-- FINISH Collaborator Update Modal -->
<!-- Collaborator Address Update Modal -->
<div class="modal fade " id="CollaboratorUpdateAddressModal" tabindex="-1" role="dialog" aria-labelledby="CollaboratorUpdateAddressModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="CollaboratorUpdateAddressModalTitle">Atualizar Dados - Endereço</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.update.collaborator.address',[
                'year'              => $current_school_year,
                'collaborator_id'   => $collaborator_data->id
            ])}}" method="POST">
                {!! csrf_field()!!}
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="street">Rua</label>
                        <input type="text" class="form-control rounded-borders" id="street" name="street" placeholder="Rua" value="{{$collaborator_data->street}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="block">Quadra</label>
                        <input type="text" class="form-control rounded-borders" id="block" name="block" placeholder="Quadra" value="{{$collaborator_data->block}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="land_lot">Lote</label>
                        <input type="text" class="form-control rounded-borders" id="land_lot" name="land_lot" placeholder="Lote" value="{{$collaborator_data->land_lot}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="number">Número</label>
                        <input type="text" class="form-control rounded-borders" id="number" name="number" placeholder="Número" value="{{$collaborator_data->number}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="neighborhood">Bairro</label>
                        <input type="text" class="form-control rounded-borders" id="neighborhood" name="neighborhood" placeholder="Bairro" value="{{$collaborator_data->neighborhood}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="zipcode">CEP</label>
                        <input type="text" class="form-control rounded-borders" id="zipcode" name="zipcode" placeholder="CEP" value="{{$collaborator_data->zipcode}}">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="complement">Complemento</label>
                        <input type="text" class="form-control rounded-borders" id="complement" name="complement" value="{{$collaborator_data->complement}}">
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
<!-- FINISH Collaborator Address Modal -->
<!-- Collaborator Scholarity Update Modal -->
<div class="modal fade " id="CollaboratorUpdateScholarityModal" tabindex="-1" role="dialog" aria-labelledby="CollaboratorUpdateScholarityModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="CollaboratorUpdateScholarityModalTitle">Atualizar Dados - Escolaridade</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.update.collaborator.scholarity',[
                'year'              => $current_school_year,
                'collaborator_id'   => $collaborator_data->id
            ])}}" method="POST">
                {!! csrf_field()!!}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="scholarity_id">Escolaridade</label>
                        <select class="custom-select form-control  rounded-borders" name="scholarity_id">
                            <option value="{{$collaborator_data->scholarity_id}}">{{$collaborator_data->scholarity}}</option>
                            @foreach($scholarities as $scholarity)
                                <option value="{{$scholarity->id}}">{{$scholarity->scholarity}}</option>
                            @endforeach
                        </select>
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
<!-- FINISH Collaborator Scholarity Modal -->
<!-- Collaborator Contact Update Modal -->
<div class="modal fade " id="CollaboratorUpdateContactModal" tabindex="-1" role="dialog" aria-labelledby="CollaboratorUpdateContactModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="CollaboratorUpdateContactModalTitle">Atualizar Dados - Contato</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.update.collaborator.contact',[
                'year'              => $current_school_year,
                'collaborator_id'   => $collaborator_data->id
            ])}}" method="POST">
                {!! csrf_field()!!}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone1">Telefone 1</label>
                        <input type="text" class="form-control rounded-borders" id="phone1" name="phone1" placeholder="Telefone" value="{{$collaborator_data->phone1}}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="phone2">Telefone 2</label>
                        <input type="text" class="form-control rounded-borders" id="phone2" name="phone2" placeholder="Telefone" value="{{$collaborator_data->phone2}}">
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
<!-- FINISH Collaborator Contact Modal -->
<!-- Collaborator Job Update Modal -->
<div class="modal fade " id="CollaboratorUpdateJobModal" tabindex="-1" role="dialog" aria-labelledby="CollaboratorUpdateJobModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="CollaboratorUpdateJobModalTitle">Atualizar Dados - Trabalho</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.update.collaborator.job',[
                'year'              => $current_school_year,
                'collaborator_id'   => $collaborator_data->id
            ])}}" method="POST">
                {!! csrf_field()!!}
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="job_year">Ano de Trabalho</label>
                        <input type="text" class="form-control rounded-borders" id="job_year" name="job_year" placeholder="Ano" value="{{$collaborator_data->job_year}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="job_status">Status</label>
                        <select class="custom-select form-control  rounded-borders" name="job_status">
                            <option selected value="{{$collaborator_data->job_status}}">{{$collaborator_data->job_status}}</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="job_id">Cargo</label>
                        <select class="custom-select form-control  rounded-borders" name="job_id">
                            <option value="{{$collaborator_data->job_id}}">{{$collaborator_data->office}}</option>
                            @foreach($jobs as $job)
                                <option value="{{$job->id}}">{{$job->office}}</option>
                            @endforeach
                        </select>
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
<!-- FINISH Collaborator Job Modal -->
@stop