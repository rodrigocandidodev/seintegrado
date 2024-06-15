@extends('layouts/pages')

@section('conteudo')
<div class="container">
    <div class="row">
        <div class="painel-list">
            <h3 class="text-center">Planejamentos Diários</h3>
            <hr>
        </div>
    </div>
    <div class="row">
    	<div class="painel-list">
        	<ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.plan.home',$current_school_year)}}">Grupos de Planejamentos</a>
                </li>
            </ul>
    	</div>
    </div>   
</div>
<div class="container mt-3">
    <div class="row">
        <div class="painel-list">
            <ul class="list-group">
                <li class="painel-list-item bg-orange ">
                    <ul class="list-group painel-list-cel text-white">
                        <span class="badge painel-list-item-index">#</span>
                        <li class="list-group-item painel-list-cel-item bg-orange">Data do Plano</li>
                        <li class="list-group-item painel-list-cel-item bg-orange">Turma</li>
                        <li class="list-group-item painel-list-cel-item bg-orange">Divisão</li>
                        <li class="list-group-item painel-list-cel-item bg-orange">Professor(a)</li>
                    </ul>
                </li>
                @foreach($daily_plans as $dp)
                <a href="#">
                    <li class="painel-list-item bg-white ">
                        <ul class="list-group painel-list-cel">
                            <span class="badge painel-list-item-index">{{$daily_plans_counter++}}</span>
                            <li class="list-group-item painel-list-cel-item bg-white">{{date("d/m/Y", strtotime($dp->plan_date))}}</li>
                            <li class="list-group-item painel-list-cel-item bg-white">{{$dp->institution_class}}</li>
                            <li class="list-group-item painel-list-cel-item bg-white">{{$dp->division}}</li>
                            <li class="list-group-item painel-list-cel-item bg-white">{{$dp->name}}</li>
                        </ul>
                    </li>
                </a>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- New Daily Plan Modal -->
<div class="modal fade " id="newDailyPlanModal" tabindex="-1" role="dialog" aria-labelledby="newDailyPlanModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newDailyPlanModalTitle">Novo Planejamento Diário</h5>
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
                    <label for="input_school_year_division">Divisão</label>
                    <select class="custom-select form-control  rounded-borders" name="school_year_division_id" id="input_school_year_division" readonly>
                        @foreach($school_year_divisions as $data)
                            <option value="{{$data->id}}">{{$data->division}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END New Daily Plan Modal -->

@stop