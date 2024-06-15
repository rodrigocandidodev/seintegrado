@extends('layouts/pages')

@section('conteudo')

    <div class="container">
        <div class="row">
            <div class="painel-list">
                <h3 class="text-center">Avaliações - {{$current_division}}</h3>
                @if(Session::has('message'))
                    <div id="notification_tab" class="p-3 mb-2 bg-orange text-white text-center rounded-borders">{{ Session::get('message') }}</div>
                @endif
                <br>
            </div>
        </div>
        <div class="row mt-3">
            <div class="painel-list">
                <ul class="list-group">
                    <li class="painel-list-item bg-orange text-white">
                        <ul class="list-group painel-list-cel">
                            <span class="badge painel-list-item-index">#</span>
                            <li class="list-group-item painel-list-name-cel bg-transparent">Avaliação</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent">Data da Avaliação</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent ">Componente Curricular</li>
                            <li class="list-group-item painel-list-cel-item bg-transparent ">Turma</li>
                        </ul>
                    </li>
                    <?php $counter=1; ?>
                    @foreach($exams as $data)
                        <a href="#" data-toggle="modal" data-target="#exam{{$data->id}}">
                            <li class="painel-list-item">
                                <ul class="list-group painel-list-cel">
                                    <span class="badge painel-list-item-index">{{$counter++}}</span>
                                    <li class="list-group-item  painel-list-name-cel">{{$data->exam}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{date("d/m/Y", strtotime($data->exam_date))}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{$data->component}}</li>
                                    <li class="list-group-item painel-list-cel-item">{{$data->institution_class}}</li>
                                </ul>
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

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
                            <a class="text-white" href="{{route('teacher.exams.results',[
                                'year'      => $current_school_year,
                                'exam_id'   => $e->id
                            ])}}">Resultados</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <small>Título</small>
                            <h4>{{$e->exam}}</h4>
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
    @endforeach
@stop