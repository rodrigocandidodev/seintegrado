@extends('layouts/pages')

@section('conteudo')
<div class="container">
    <div class="row">
        <div class="painel-list text-center">
            <h3>Planejamentos Diários do {{$group_info->abbreviation}} ({{$group_info->name}})</h3>
            <span>{{date('d/m', strtotime($group_info->first_day))}} - {{date('d/m',strtotime($group_info->last_day))}}</span>
            <hr>
        </div>
    </div>
    <div class="row">
    	<div class="painel-list">
        	<ul class="nav justify-content-center">
              	<li class="nav-item">
                	<a class="nav-link" href="#" data-toggle="modal" data-target="#newDailyPlanModal">Novo Planejamento Diário</a>
              	</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('teacher.plans.home',$current_school_year)}}">Grupos de Planejamentos</a>
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
                    </ul>
                </li>
                @foreach($daily_plans as $dp)
                <a href="#" data-toggle="modal" data-target="#dailyPlanModal{{$daily_plans_counter}}">
                    <li class="painel-list-item bg-white ">
                        <ul class="list-group painel-list-cel">
                            <span class="badge painel-list-item-index">{{$daily_plans_counter++}}</span>
                            <li class="list-group-item painel-list-cel-item bg-white">{{date("d/m/Y", strtotime($dp->plan_date))}}</li>
                            <li class="list-group-item painel-list-cel-item bg-white">{{$dp->institution_class}}</li>
                            <li class="list-group-item painel-list-cel-item bg-white">{{$dp->division}}</li>
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
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newDailyPlanModalTitle">Novo Planejamento Diário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('teacher.daily.plan.submit',$current_school_year)}}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="institution_id">Instituição</label>
                    <select class="custom-select form-control  rounded-borders" name="institution_id" readonly>
                        <option value="{{$online_collaborator_institution_id}}">{{$online_institution_name}}</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="input_teacher">Professor</label>
                    <select class="custom-select form-control  rounded-borders" id="input_teacher" name="teacher_id" readonly>
                        <option value="{{$online_teacher_id}}">{{$online_collaborator_name}}</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="input_group_info">Grupo Atual</label>
                    <select class="custom-select form-control  rounded-borders" id="input_group_info" name="group_id" readonly>
                        <option value="{{$group_info->id}}">{{$group_info->name}}</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="input_plan_delivery">Data de entrega do planejamento</label>
                    <input type="date" class="form-control rounded-borders" id="input_plan_delivery" name="delivery_date" title="Data de entrega" value="{{$group_info->first_day}}" required readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="input_school_year">Ano Atual</label>
                    <select class="custom-select form-control  rounded-borders" id="input_school_year" name="school_year_id" readonly>
                        <option value="{{$school_year_id}}">{{$current_school_year}}</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="input_creation_date">Data de criação</label>
                    <input type="date" class="form-control rounded-borders" id="input_creation_date" name="plan_created_at" title="Data de criação" value="{{date('Y-m-d')}}" required readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="input_plan_date">Data do plano (Dia de aula)</label>
                    <input type="date" class="form-control rounded-borders" id="input_plan_date" name="plan_date" title="Data do plano" min="{{$group_info->first_day}}" max="{{$group_info->last_day}}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="input_school_year_division">Divisão</label>
                    <select class="custom-select form-control  rounded-borders" name="school_year_division_id" id="input_school_year_division">
                        <option value="">Selecione uma divisão</option>
                        @foreach($school_year_divisions as $data)
                            <option value="{{$data->id}}">{{$data->division}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="input_classes">Turma</label>
                    <select class="custom-select form-control  rounded-borders" name="class_plan" id="input_classes">
                        <option value="">Selecione uma turma</option>
                        @foreach($institution_classes as $ic)
                            <option value="{{$ic->id}}">{{$ic->institution_class}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md-12">
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
            </div>
            
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END New Daily Plan Modal -->
<?php $daily_plans_counter = 0; ?>
@foreach($daily_plans as $dp)
    <!--  Daily Plan Modal -->
    <div class="modal fade " id="dailyPlanModal{{$daily_plans_counter}}" tabindex="-1" role="dialog" aria-labelledby="dailyPlanModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newDailyPlanModalTitle">Planejamento Diário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                @if($dp->scholarity_id == 1)
                    <div class="col-md-12">
                        <h6>Professor (a): <strong>{{$online_collaborator_name}}</strong></h6>
                        <h6>Data do plano: <strong>{{date("d/m/Y", strtotime($dp->plan_date))}}</strong></h6>
                        <h6>Data de entrega: <strong>{{date("d/m/Y", strtotime($group_info->first_day))}}</strong></h6>
                        <h6>Divisão: <strong>{{$dp->division}}</strong></h6>
                        <h6>Turma/Nível: <strong>{{$dp->institution_class}}</strong></h6>
                        <hr>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <a href="#" data-toggle="modal" data-target="#chooseAreaModal{{$daily_plans_counter}}">Adicionar Plano de aula</a>
                            </div>
                        </div>
                        <div class="painel-list">
                            <ul class="list-group">
                                <a href="#">
                                    <li class="painel-list-item bg-orange text-white">
                                        <ul class="list-group painel-list-cel">
                                            <li class="list-group-item border-0 bg-transparent">Língua Portuguesa</li>
                                        </ul>
                                    </li>
                                </a>
                            </ul>

                        </div>
                    </div>
                @else
                    @if($dp->scholarity_id == 2)
                        <div class="col-md-12">
                            <h6>Professor (a): <strong>{{$online_collaborator_name}}</strong></h6>
                            <h6>Data do plano: <strong>{{date("d/m/Y", strtotime($dp->plan_date))}}</strong></h6>
                            <h6>Data de entrega: <strong>{{date("d/m/Y", strtotime($group_info->first_day))}}</strong></h6>
                            <h6>Divisão: <strong>{{$dp->division}}</strong></h6>
                            <h6>Turma/Nível: <strong>{{$dp->institution_class}}</strong></h6>
                        </div>
                        <hr>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <a href="#" data-toggle="modal" data-target="#chooseAreaModal{{$daily_plans_counter}}">Adicionar Plano de aula</a>
                            </div>
                        </div>
                        <div class="painel-list">
                            <ul class="list-group">
                                <a href="#">
                                    <li class="painel-list-item bg-white ">
                                        <ul class="list-group painel-list-cel">
                                            <li class="list-group-item painel-list-name-cel bg-white">Língua Portuguesa</li>
                                        </ul>
                                    </li>
                                </a>
                            </ul>
                        </div>
                    @endif
                @endif
                <h5></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END  Daily Plan Modal -->
    <?php $daily_plans_counter++; ?>
@endforeach

<?php 
    $daily_plans_counter=0; 
    $knowledge_area_selection = 'LC';
?>

@foreach($daily_plans as $dp)
<div class="modal fade " id="chooseAreaModal{{$daily_plans_counter}}" tabindex="-1" role="dialog" aria-labelledby="chooseAreaModalTitle{{$daily_plans_counter}}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chooseAreaModalTitle{{$daily_plans_counter}}">Novo Plano de Aula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Selecione para qual área do conhecimento deseja criar um plano!</span>
                <div class="row">
                    <ul class="list-group">
                        <a href="#" data-toggle="modal" id="knowledge_area_lc" data-target="#newPlanModallc{{$daily_plans_counter}}">
                            <li class="painel-list-item bg-white ">
                                <ul class="list-group painel-list-cel">
                                    <li class="list-group-item painel-list-name-cel-item bg-white">Linguagens e Códigos</li>
                                </ul>
                            </li>
                        </a>
                        <a href="#" data-toggle="modal" id="knowledge_area_mt" data-target="#newPlanModalmt{{$daily_plans_counter}}">
                            <li class="painel-list-item bg-white ">
                                <ul class="list-group painel-list-cel">
                                    <li class="list-group-item painel-list-name-cel-item bg-white">Ciências da Natureza e Humanas e Matemática</li>
                                </ul>
                            </li>
                        </a>
                    </ul>
                </div>  
            </div>
        </div>
    </div>
</div>
<?php $daily_plans_counter++; ?>
@endforeach

<?php $daily_plans_counter = 0; ?>
@foreach($daily_plans as $dp)
    <!--  Daily Plan Modal -->
    <div class="modal fade " id="newPlanModallc{{$daily_plans_counter}}" tabindex="-1" role="dialog" aria-labelledby="newPlanModallcTitle{{$daily_plans_counter}}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newPlanModallcTitle{{$daily_plans_counter}}">Novo Plano de Aula</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="#" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_title{{$daily_plans_counter}}">Título/Tema da aula</label>
                        <input type="text" class="form-control rounded-borders" id="input_titlelc{{$daily_plans_counter}}" name="title_theme" title="Título/Tema da aula" required placeholder="Título/Tema"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_daily_plan{{$daily_plans_counter}}">Data do Planejamento Diário</label>
                        <select class="custom-select form-control  rounded-borders" id="input_daily_planlc{{$daily_plans_counter}}" name="daily_plan_id" required readonly>
                            <option value="{{$dp->id}}">{{date('d/m/Y', strtotime($dp->plan_date))}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_curricular_component{{$daily_plans_counter}}">Componente Curricular</label>
                        <select class="custom-select form-control  rounded-borders" id="input_curricular_componentlc{{$daily_plans_counter}}" name="curricular_component_id" required>
                            <option value="">Selecione</option>
                            @foreach($curricular_components as $data)
                                <option value="{{$data->id}}">{{$data->component}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_practical_language_thematic_axis">Práticas de Linguagem/Eixos</label>
                        <select class="custom-select form-control  rounded-borders" id="input_practical_language_thematic_axis" name="practical_language_thematic_axis_id" required>
                            <option value="">Selecione</option>
                            @foreach($practical_language_thematic_axes as &$data)
                                <option value="{{$data['plta_id']}}">{{$data['plta']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_prior_knowledge{{$daily_plans_counter}}">Conhecimentos Prévios</label>
                        <input type="text" class="form-control rounded-borders" id="input_prior_knowledgelc{{$daily_plans_counter}}" name="prior_knowledge" title="Conhecimentos Prévios" required placeholder="Conhecimentos Prévios">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_materials_required{{$daily_plans_counter}}">Materiais Necessários</label>
                        <input type="text" class="form-control rounded-borders" id="input_materials_requiredlc{{$daily_plans_counter}}" name="materials_required" title="Materiais Necessários" required placeholder="Materiais Necessários"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_practical_application{{$daily_plans_counter}}">Aplicação/Fixação</label>
                        <input type="text" class="form-control rounded-borders" id="input_practical_applicationlc{{$daily_plans_counter}}" name="practical_application" title="Aplicação" required placeholder="Aplicação/Fixação"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_evaluation{{$daily_plans_counter}}">Síntese/Avaliação</label>
                        <input type="text" class="form-control rounded-borders" id="input_evaluationlc{{$daily_plans_counter}}" name="evaluation" title="Avaliação" required placeholder="Avaliação"> 
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
                </div>

                
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- END  Daily Plan Modal -->
    <?php $daily_plans_counter++; ?>
@endforeach

<?php $daily_plans_counter = 0; ?>
@foreach($daily_plans as $dp)
    <!--  Daily Plan Modal -->
    <div class="modal fade " id="newPlanModalmt{{$daily_plans_counter}}" tabindex="-1" role="dialog" aria-labelledby="newPlanModalmtTitle{{$daily_plans_counter}}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newPlanModalmtTitle{{$daily_plans_counter}}">Novo Plano de Aula</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="#" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_title{{$daily_plans_counter}}">Título/Tema da aula</label>
                        <input type="text" class="form-control rounded-borders" id="input_titlemt{{$daily_plans_counter}}" name="title_theme" title="Título/Tema da aula" required placeholder="Título/Tema"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_daily_plan{{$daily_plans_counter}}">Data do Planejamento Diário</label>
                        <select class="custom-select form-control  rounded-borders" id="input_daily_planmt{{$daily_plans_counter}}" name="daily_plan_id" required readonly>
                            <option value="{{$dp->id}}">{{date('d/m/Y', strtotime($dp->plan_date))}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_curricular_component{{$daily_plans_counter}}">Componente Curricular</label>
                        <select class="custom-select form-control  rounded-borders" id="input_curricular_componentmt{{$daily_plans_counter}}" name="curricular_component_id" required>
                            <option value="">Selecione</option>
                            @foreach($curricular_components as $data)
                                <option value="{{$data->id}}">{{$data->component}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row" id="pftu_plta_generation">
                    <div class="form-group col-md-12">
                        <label for="input_application_field_thematic_unit">Campo de Atuação/Unidade Temática</label>
                        <select class="custom-select form-control  rounded-borders" id="input_application_field_thematic_unit" name="application_field_thematic_unit_id" required>
                            <option value="">Selecione</option>
                            @foreach($application_field_thematic_units as &$data)
                                <option value="{{$data['aftu_id']}}">{{$data['aftu']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_prior_knowledge{{$daily_plans_counter}}">Conhecimentos Prévios</label>
                        <input type="text" class="form-control rounded-borders" id="input_prior_knowledgemt{{$daily_plans_counter}}" name="prior_knowledge" title="Conhecimentos Prévios" required placeholder="Conhecimentos Prévios">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_materials_required{{$daily_plans_counter}}">Materiais Necessários</label>
                        <input type="text" class="form-control rounded-borders" id="input_materials_requiredmt{{$daily_plans_counter}}" name="materials_required" title="Materiais Necessários" required placeholder="Materiais Necessários"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_practical_application{{$daily_plans_counter}}">Aplicação/Fixação</label>
                        <input type="text" class="form-control rounded-borders" id="input_practical_applicationmt{{$daily_plans_counter}}" name="practical_application" title="Aplicação" required placeholder="Aplicação/Fixação"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input_evaluation{{$daily_plans_counter}}">Síntese/Avaliação</label>
                        <input type="text" class="form-control rounded-borders" id="input_evaluationmt{{$daily_plans_counter}}" name="evaluation" title="Avaliação" required placeholder="Avaliação"> 
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
                </div>

                
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- END  Daily Plan Modal -->
    <?php $daily_plans_counter++; ?>
@endforeach

<script type="text/javascript">
    function RedirectFromKnowledgeArea(knowledge_area){
        //alert(knowledge_area);
        //if (knowledge_area == 'LC' ? console.log('LC') : console.log('MT'));
        //gerar os campos aqui dentro da div com o id
        //ou colocar duas modais diferentes
        const divFormRow   = document.getElementById('pftu_plta_generation');
        console.log(divFormRow);
        if (knowledge_area == 'LC') {

        }else{
            if (knowledge_area == 'MT') {
                const divFormGroup = document.createElement('div');
                divFormGroup.setAttribute('class', 'form-group col-md-12');

                const label = document.createElement('label');
                label.setAttribute('for', 'input_application_field_thematic_unit');
                const text = document.createTextNode('Campo de Aplicação/Unidade Temática');
                label.appendChild(text);

                divFormGroup.appendChild(label);

                divFormRow.appendChild(divFormGroup);

            }else{
                console.log('ERROR');
            }
        }
        

        
    }
</script>
@stop