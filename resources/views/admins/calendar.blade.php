@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-list">
                <h3 class="text-center">Calendário</h3>
                <hr>
                <ul class="nav justify-content-center">
                  <li class="nav-item  menu-down-upon-content">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#newDateModal">Adicionar Data</a>
                  </li>
                </ul>
            </div>
        </div>
        <div class="container">
            @for($i=0;$i<$months_length;$i++)
                <div class="row">
                    <div class="col-md-12 margin-top-20">
                        <h3>{{$months[$i]}}</h3>
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#newDateModal">Adicionar Data</a>
                    </div>
                </div>
                <div class="row mb-3">
                @foreach($calendar_days as $data)
                    @if(date('m',strtotime($data->day))==$i+1)
                        @if($data->activity_id == 1)
                            <div class="inline-list-squares text-center bg-white">
                                <a class="text-muted" href="#" data-toggle="modal" data-target="#m{{date('Ymd', strtotime($data->day))}}">
                                    <h1 class="mt-2">{{date('d', strtotime($data->day))}}</h1>
                                </a>
                            </div>
                        @else
                            @if($data->activity_id == 2)
                                <div class="inline-list-squares text-center bg-seintegrado-pink">
                                    <a class="text-muted" href="#" data-toggle="modal" data-target="#m{{date('Ymd', strtotime($data->day))}}">
                                        <h1 class="mt-2 text-white">{{date('d', strtotime($data->day))}}</h1>
                                    </a>
                                </div>
                            @else
                                @if($data->activity_id == 3)
                                    <div class="inline-list-squares text-center bg-seintegrado-orange">
                                        <a class="text-muted" href="#" data-toggle="modal" data-target="#m{{date('Ymd', strtotime($data->day))}}">
                                            <h1 class="mt-2 text-white">{{date('d', strtotime($data->day))}}</h1>
                                        </a>
                                    </div>
                                @else
                                    @if($data->activity_id == 4)
                                        <div class="inline-list-squares text-center bg-seintegrado-yellow">
                                            <a class="text-muted" href="#" data-toggle="modal" data-target="#m{{date('Ymd', strtotime($data->day))}}">
                                                <h1 class="mt-2 text-white">{{date('d', strtotime($data->day))}}</h1>
                                            </a>
                                        </div>
                                    @else
                                        @if($data->activity_id == 5)
                                            <div class="inline-list-squares text-center bg-seintegrado-purple">
                                                <a class="text-muted" href="#" data-toggle="modal" data-target="#m{{date('Ymd', strtotime($data->day))}}">
                                                <h1 class="mt-2 text-white">{{date('d', strtotime($data->day))}}</h1>
                                            </a>
                                        </div>
                                        @else
                                            @if($data->activity_id == 6)
                                                <div class="inline-list-squares text-center bg-seintegrado-blue">
                                                    <a class="text-muted" href="#" data-toggle="modal" data-target="#m{{date('Ymd', strtotime($data->day))}}">
                                                        <h1 class="mt-2 text-white">{{date('d', strtotime($data->day))}}</h1>
                                                    </a>
                                                </div>
                                            @else
                                                @if($data->activity_id == 7)
                                                    <div class="inline-list-squares text-center bg-orange">
                                                        <a class="text-muted" href="#" data-toggle="modal" data-target="#m{{date('Ymd', strtotime($data->day))}}">
                                                            <h1 class="mt-2 text-white">{{date('d', strtotime($data->day))}}</h1>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="inline-list-squares text-center bg-seintegrado-gray">
                                                        <a class="text-muted" href="#" data-toggle="modal" data-target="#m{{date('Ymd', strtotime($data->day))}}">
                                                            <h1 class="mt-2 text-white">{{date('d', strtotime($data->day))}}</h1>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endif
                    @endif
                @endforeach
                </div>
            @endfor
        </div>
    </div>
    <!-- New Day Modal -->
    <div class="modal fade " id="newDateModal" tabindex="-1" role="dialog" aria-labelledby="newDateModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newDateModalTitle">Nova Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.store.calendar.day.submit',$current_school_year)}}" method="POST">
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
                        <select class="custom-select form-control  rounded-borders" name="year" required readonly>
                            <option value="{{$current_school_year}}">{{$current_school_year}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Título</label>
                        <input type="text" class="form-control rounded-borders" name="motive" placeholder="Título" title="Título do dia" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Data</label>
                        <input type="date" class="form-control rounded-borders" name="day" title="Data" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Dia letivo?</label>
                        <select class="custom-select form-control  rounded-borders" name="class_day" required>
                            <option value="">Selecione</option>
                            <option value="yes">Sim</option>
                            <option value="no">Não</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Atividade</label>
                        <select class="custom-select form-control rounded-borders" name="activity_id">
                            <option value="">Selecione</option>
                            @foreach($calendar_activities as $ca)
                                <option value="{{$ca->id}}">{{$ca->activity}}</option>
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
    <!-- ENDING New Day Modal -->

    <!-- days Modal -->
    @foreach($calendar_days as $data)
        <div class="modal fade " id="m{{date('Ymd', strtotime($data->day))}}" tabindex="-1" role="dialog" aria-labelledby="m{{date('Ymd', strtotime($data->day))}}Title" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="m{{date('Ymd', strtotime($data->day))}}Title">Atividade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('admin.delete.calendar-day',['year' => $current_school_year, 'id' => $data->id])}}">Apagar</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <small>Título</small>
                        <h4>{{$data->motive}}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <small>Data</small>
                        <h4>{{date('d/m/Y',strtotime($data->day))}}</h4>
                    </div>
                    <div class="col-md-6">
                        <small>Dia da Semana</small>
                        @if(date('w',strtotime($data->day))==0)
                            <h4>Domingo</h4>
                        @else
                            @if(date('w',strtotime($data->day))==1)
                                <h4>Segunda-feira</h4>
                            @else
                                @if(date('w',strtotime($data->day))==2)
                                    <h4>Terça-feira</h4>
                                @else
                                    @if(date('w',strtotime($data->day))==3)
                                        <h4>Quarta-feira</h4>
                                    @else
                                        @if(date('w',strtotime($data->day))==4)
                                            <h4>Quinta-feira</h4>
                                        @else
                                            @if(date('w',strtotime($data->day))==5)
                                                <h4>Sexta-feira</h4>
                                            @else
                                                @if(date('w',strtotime($data->day))==6)
                                                    <h4>Sábado</h4>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <small>Dia letivo?</small>
                        @if($data->class_day == 'no')
                            <h4>Não</h4>
                        @else
                            @if($data->class_day == 'yes')
                                <h4>Sim</h4>
                            @endif
                        @endif
                    </div>
                    <div class="col-md-6">
                        <small>Atividade</small>
                        <h4>{{$data->activity}}</h4>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    @endforeach
    <!-- ENDING days Modal -->
@stop