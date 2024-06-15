@extends('layouts/pages')

@section('conteudo')
    @if(!is_null($expected_total_hours))
        @if(!is_null($teacher_data))
            @if(count($week_day_classes)>0)
                <div class="container">
                    <div class="row">
                        <div class="painel-list">
                            <h3 class="text-center">Previsão de {{$curricular_component_name}} do {{$class_name}}</h3>
                            <hr>
                            <ul class="list-group">
                                <ul class="nav justify-content-center">
                                  <li class="nav-item menu-down-upon-content">
                                    <a class="nav-link" href="{!! route('admin.prevision.data.sheet',[
                                        'year'=> $current_school_year, 
                                        'class_id'=> $class_id, 
                                        'teacher_id' => $teacher_data->teacher_id,
                                        'currricular_component_id' => $currricular_component_id
                                        ]); 
                                    !!}">Exportar Planilha</a>
                                  </li>
                                  <li class="nav-item menu-down-upon-content">
                                    
                                  </li>
                                  <li class="nav-item menu-down-upon-content">
                                    <a class="nav-link" href="{!! route('admin.calendar',$current_school_year); !!}">Calendário</a>
                                  </li>
                                  <li class="nav-item menu-down-upon-content">
                                    <a class="nav-link" href="#" data-toggle="modal" data-target="#previsionModal">Outras Previsão</a>
                                  </li>
                                  <li class="nav-item menu-down-upon-content">
                                    <a class="nav-link" href="{{route('admin.show.class.students',['year' => $current_school_year, 'class_id' => $class_id ])}}">Ir para Turma</a>
                                  </li>
                                </ul>
                        </div>
                    </div>
                    <h3>Cargas Horárias</h3>
                    <div class="row">
                        <div class="inline-list-rectangles text-center bg-white">
                            <a class="text-muted" href="#">
                                <small>Carga Horária Esperada</small>
                                <h3 class="margin-top-20">{{$expected_total_hours}}</h3>
                                <small>Horas</small>
                            </a>
                        </div>
                        <div class="inline-list-rectangles text-center bg-white">
                            <a class="text-muted" href="#">
                                <small>Carga Horária Atual</small>
                                <h3 class="margin-top-20">{{$counter_total_hours}}</h3>
                                <small>Horas</small>
                            </a>
                        </div>
                    </div>

                    @for($i=0;$i<$months_length;$i++)
                        <div class="row">
                            <div class="col-md-12 margin-top-20">
                                <h3>{{$months[$i]}}</h3>
                                <small><a href="{!! route('admin.daily.class.data.sheet',[
                                    'year'=> $current_school_year, 
                                    'class_id'=> $class_id, 
                                    'teacher_id' => $teacher_data->teacher_id, 
                                    'currricular_component_id' => $currricular_component_id,
                                    'month' => $i
                                ]); !!}">Planilha</a></small>

                            </div>
                        </div>
                        <div class="row">
                        @foreach($prevision_sumary as $ps)
                            @if(date('m',strtotime($ps['calendar_day']))==$i+1)
                                <div class="inline-list-rectangles text-center bg-white">
                                    <a class="text-muted" href="#">
                                        <h3 class="margin-top-20">{{date('d/m',strtotime($ps['calendar_day']))}}</h3>
                                        @if(date('w',strtotime($ps['calendar_day']))==0)
                                            <small>Domingo</small>
                                        @else
                                            @if(date('w',strtotime($ps['calendar_day']))==1)
                                                <small>Segunda-feira</small>
                                            @else
                                                @if(date('w',strtotime($ps['calendar_day']))==2)
                                                    <small>Terça-feira</small>
                                                @else
                                                    @if(date('w',strtotime($ps['calendar_day']))==3)
                                                        <small>Quarta-feira</small>
                                                    @else
                                                        @if(date('w',strtotime($ps['calendar_day']))==4)
                                                            <small>Quinta-feira</small>
                                                        @else
                                                            @if(date('w',strtotime($ps['calendar_day']))==5)
                                                                <small>Sexta-feira</small>
                                                            @else
                                                                @if(date('w',strtotime($ps['calendar_day']))==6)
                                                                    <small>Sábado</small>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                        <p>{{$ps['amount'].' aulas'}}</p>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                        </div>
                    @endfor
                  </div>
                </div>

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
                                'class_id'  => $class_id
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
            @else
            <div class="container">
                <div class="row">
                    <div class="painel-list text-center">
                        <h3 class="text-center">Previsão de {{$curricular_component_name}} do {{$class_name}} não existe!</h3>
                            <h5 class="text-center">Ops! Não há horário de aula definido!</h5>
                        <a class="nav-link" href="{{route('admin.show.class.students',['year' => $current_school_year, 'class_id' => $class_id ])}}">Ir para Turma</a>
                    </div>
                </div>
            </div>

            @endif
        @else
            <div class="container">
                <div class="row">
                    <div class="painel-list text-center">
                        <h3 class="text-center">Previsão de {{$curricular_component_name}} do {{$class_name}} não existe!</h3>
                            <h5 class="text-center">Ops! O(A) professor (a) desta componente curricular não foi definido (a)!</h5>
                        <a class="nav-link" href="{{route('admin.show.class.students',['year' => $current_school_year, 'class_id' => $class_id ])}}">Ir para Turma</a>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="container">
            <div class="row">
                <div class="painel-list text-center">
                    <h3 class="text-center">Previsão de {{$curricular_component_name}} do {{$class_name}} não existe!</h3>
                        <h5 class="text-center">Ops! Este ano escolar não possui esta componente curricular!</h5>
                    <a class="nav-link" href="{{route('admin.show.class.students',['year' => $current_school_year, 'class_id' => $class_id ])}}">Ir para Turma</a>
                </div>
            </div>
        </div>
    @endif
@stop
