@extends('layouts/pages')

@section('conteudo')
    <!--STICKY-MENU-BAR-->
    <div class="nav-scroller py-1 mb-2">
        <h4 class="text-center">Home</h4>
        <hr>   
    </div>
    <!--GRID-MENU-->
    <div class="container">
        <div class="row">
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="#" title="Avaliações" data-toggle="modal" data-target="#examsModal">
                    <h1 class="margin-top-10">Av</h1>
                    <p>Avaliações</p>
                </a>
            </div>
            <!--<div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="{{ route('teacher.plans.home',$current_school_year)}}" title="Grupos de Planejamentos Diários">
                    <h1 class="margin-top-10">Gr</h1>
                    <p>Grupos</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white rounded-borders-10">
                <a class="text-muted" href="#" title="Campos de Atuação, Unidades Temáticas, Práticas de Linguagem e Eixos Temáticos" data-toggle="modal" data-target="#aftu_plta_Modal">
                    <h1 class="margin-top-10">UT</h1>
                    <p>Unidades Temáticas</p>
                </a>
            </div>-->
        </div>
    </div>

    <!-- exams Modal  -->
    <div class="modal fade " id="examsModal" tabindex="-1" role="dialog" aria-labelledby="examsModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="examsModalTitle">Avaliações</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Selecione uma divisão do ano!</h5>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($divisions as $d)
                            <div class="inline-list-rectangles text-center bg-white">
                                <a class="text-muted" href="{{route('teacher.exams',[
                                    'year'          => $current_school_year,
                                    'division_id'   => $d->id
                                ])}}">
                                    <h5 class="margin-top-10">{{$d->division}}</h5>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- aftu plta Modal  -->
    <div class="modal fade " id="aftu_plta_Modal" tabindex="-1" role="dialog" aria-labelledby="aftu_plta_ModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="aftu_plta_ModalTitle">Campos de Atuação, Unidades Temáticas, Práticas de Linguagem e Eixos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <h4><strong>Campos de Atuação e Unidades Temáticas</strong></h4>
                            <div class="col-md-12">
                                @while($bncc_components_counter!=0)
                                    <?php $iteration = false; ?>
                                    @foreach($application_field_thematic_units as &$data)
                                        @if($data['bncc_curricular_component_id']==$bncc_components_counter)
                                            @if(!$iteration)
                                                <h5>{{$data['bncc_curricular_component']}}</h5>
                                                <?php $iteration = true ?>
                                            @endif
                                                <li>{{$data['aftu']}}</li>
                                        @endif
                                    @endforeach
                                    <?php $bncc_components_counter--; ?>
                                @endwhile
                                <?php $bncc_components_counter = $amount_components; ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4><strong>Práticas de Linguagem e Eixos Temáticos</strong></h4>
                            <div class="col-md-12">
                                @while($bncc_components_counter!=0)
                                    <?php $iteration = false; ?>
                                    @foreach($practical_language_thematic_axes as &$data)
                                        @if($data['bncc_curricular_component_id']==$bncc_components_counter)
                                            @if(!$iteration)
                                                <h5>{{$data['bncc_curricular_component']}}</h5>
                                                <?php $iteration = true ?>
                                            @endif
                                                <li>{{$data['plta']}}</li>
                                        @endif
                                    @endforeach
                                    <?php $bncc_components_counter--; ?>
                                @endwhile
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@stop