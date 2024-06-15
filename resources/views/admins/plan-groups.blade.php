@extends('layouts/pages')

@section('conteudo')
<div class="container">
    <div class="row">
        <div class="painel-list">
            <h3 class="text-center">Grupos de Planejamentos</h3>
            <hr>
        </div>
    </div>
    <div class="row">
    	<div class="painel-list">
        	<ul class="nav justify-content-center">
              	<li class="nav-item">
                	<a class="nav-link" href="#" data-toggle="modal" data-target="#newGroupModal">Novo Grupo</a>
              	</li>
            </ul>
    	</div>
    </div>
    <?php $counter = 1; ?>
    	@foreach($all_plan_groups_data as $apgd)
    		@if($counter==1)
    			<div class="row">
    		@endif
    		<div class="menu-lista col-md-2 text-center bg-white rounded-borders">
	            <a class="text-muted" href="{{route('admin.plan.group',['year' => $current_school_year, 'group_id' => $apgd->id])}}">
	                <h1 class="margin-top-10">{{$apgd->abbreviation}}</h1>
	                <p>{{date("d/m", strtotime($apgd->first_day))}} - {{date('d/m', strtotime($apgd->last_day))}}</p>
	            </a>
	        </div>
    		@if($counter%5==0)
    			</div>
    			<?php $counter = 1; ?>
    		@else
    			<?php $counter++; ?>
    		@endif
        @endforeach
    
</div>

<!-- New Group Modal -->
<div class="modal fade " id="newGroupModal" tabindex="-1" role="dialog" aria-labelledby="newGroupModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newGroupModalTitle">Novo Grupo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.store.plan.submit',$current_school_year)}}" method="POST">
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
                    <label for="select_stored_by">Grupo sendo cadastrado por</label>
                    <select class="custom-select form-control  rounded-borders" id="select_stored_by" name="stored_by" readonly>
                        <option selected value="{{$collaborator_id}}">{{$online_collaborator_name}}</option>
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
                    <label for="input_group_name">Nome do grupo</label>
                    <input type="text" class="form-control rounded-borders" id="input_group_name" name="name" placeholder="Nome do grupo" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="input_abbreviation">Abreviação (máximo 4 caracteres)</label>
                    <input type="text" class="form-control rounded-borders" id="input_abbreviation" name="abbreviation" placeholder="Abreviação para o nome" maxlength="4" required>
                </div>
            </div>
            <div class="form-row">
                <h5>Período do grupo</h5>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="input_first_day">Data Mínima</label>
                    <input type="date" class="form-control rounded-borders" id="input_first_day" name="first_day" title="Data do primeiro planejamento do grupo" maxlength="4" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="input_last_day">Data Máxima</label>
                    <input type="date" class="form-control rounded-borders" id="input_last_day" name="last_day" title="Data do último planejamento do grupo" maxlength="4" required>
                </div>
            </div>
            
            <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END New Group Modal -->

@stop