@extends('layouts/pages')

@section('conteudo')
    <!--STICKY-MENU-BAR-->
    <div class="nav-scroller py-1 mb-2">
        <h4 class="text-center">Planejamentos Diários</h4>
        <hr>   
    </div>
    <!--GRID-MENU-->
    <div class="container">
        <div class="row">
            <div class="under-menu-box">
                <div class="md-12">
                    <h2>Grupo G1</h2>
                    <p>Grupo de planejamentos diários</p>
                    <p>Data de Início: <strong>20/10/2019</strong></p>
                    <p>Data de Finalização: <strong>15/11/2019</strong></p>
                    <p>Data de Entrega: <strong>18/10/2019</strong></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="menu-lista col-md-2 text-center bg-orange rounded-borders">
                <a class="text-muted " href="#" data-toggle="modal" data-target="#newDiaryPlanModal">
                    <p class="text-white margin-top-10">Novo Planejamento</p>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="painel-list">
                <ul class="list-group">
                    <a href="#"  data-toggle="modal" data-target="#DiaryPlanModal">
                        <li class="painel-list-item">
                            <ul class="list-group painel-list-cel">
                                <span class="badge painel-list-item-index">1</span>
                                <li class="list-group-item  painel-list-name-cel-100">Planejamento do dia <strong>15/08/2019</strong></li>
                            </ul>
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- BEGINNIG New Diary Plan Modal -->
    <div class="modal fade " id="newDiaryPlanModal" tabindex="-1" role="dialog" aria-labelledby="newDiaryPlanModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newDiaryPlanModalTitle">Novo Planejamento Diário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- END New Diary Plan Modal -->

    <!-- BEGINNIG Diary Plan Modals -->
    <div class="modal fade " id="DiaryPlanModal" tabindex="-1" role="dialog" aria-labelledby="DiaryPlanModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DiaryPlanModalTitle">Planejamento Diário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="content-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <span>Dia: <strong>15/08/2019</strong></span>
                                <span>Entrega: <strong>19/08/2019</strong></span>
                                
                                <div class="painel-list">
                                    <ul class="list-group">
                                        <a href="#"  data-toggle="modal" data-target="#PlanModal">
                                            <li class="painel-list-item text-white bg-orange">
                                                <ul class="list-group painel-list-cel">
                                                    <span class="badge painel-list-item-index">1</span>
                                                    <li class="list-group-item bg-orange painel-list-name-cel-100">Língua Portuguesa</li>
                                                </ul>
                                            </li>
                                        </a>
                                        

                                        <a href="#"  data-toggle="modal" data-target="#DiaryPlanModal">
                                            <li class="painel-list-item text-white bg-orange">
                                                <ul class="list-group painel-list-cel">
                                                    <span class="badge painel-list-item-index">2</span>
                                                    <li class="list-group-item bg-orange painel-list-name-cel-100">Matemática</li>
                                                </ul>
                                            </li>
                                        </a>
                                        <a href="#"  data-toggle="modal" data-target="#DiaryPlanModal">
                                            <li class="painel-list-item text-white bg-orange">
                                                <ul class="list-group painel-list-cel">
                                                    <span class="badge painel-list-item-index">3</span>
                                                    <li class="list-group-item bg-orange painel-list-name-cel-100">Arte</li>
                                                </ul>
                                            </li>
                                        </a>
                                        <a href="#"  data-toggle="modal" data-target="#DiaryPlanModal">
                                            <li class="painel-list-item text-white bg-orange">
                                                <ul class="list-group painel-list-cel">
                                                    <span class="badge painel-list-item-index">4</span>
                                                    <li class="list-group-item bg-orange painel-list-name-cel-100">Ciências</li>
                                                </ul>
                                            </li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Diary Plan Modals -->

    <!-- BEGINNIG Plan Modal -->
    <div class="modal fade " id="PlanModal" tabindex="-1" role="dialog" aria-labelledby="PlanModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="PlanModalTitle">Plano de Aula</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="content-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <strong>Eixos Temáticos</strong><br>
                                <span>Análise linguística: apropriação do sistema de escrita alfabética</span>
                            </div>
                            <div class="col-md-12">
                                <strong>Conteúdo</strong><br>
                                <span>Estudo da língua: Encontros - vocálicos: Ditongo, tritongo e hiato.</span>
                            </div>
                            <div class="col-md-12">
                                <strong>Objetivos de Aprendizagem</strong><br>
                                <span>Identificar encontros vocálicos.</span>
                            </div>
                            <div class="col-md-12">
                                <strong>Estratégias de Aprendizagem</strong><br>
                                <span>Exploração oral, escrita no caderno.(classifique os encontros vocálicos assinalados )</span>
                            </div>
                            <div class="col-md-12">
                                <strong>Avaliação</strong><br>
                                <span>Será contínua mediante a participação e realização das atividades.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Plan Modal -->

@stop