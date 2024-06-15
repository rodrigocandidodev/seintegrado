@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-grid rounded-borders">
                <div class="painel-box">
                    <div class="painel-box-header">
                        <h3>Configurações</h3>
                    </div>
                    <hr>
                    <div class="painel-box-body">
                        <h5>Dados da Instituição</h5>
                        <ul>
                            <li><a href="#" data-toggle="modal" data-target="#nomeInstituicaoModal">Nome</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#anoLetivoModal">Ano Letivo</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#anosEscolaresModal">Anos Escolares</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#inepModal">INEP</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Nome Modal-->
    <div class="modal fade " id="nomeInstituicaoModal" tabindex="-1" role="dialog" aria-labelledby="nomeInstituicaoModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="nomeInstituicaoModalTitle">Nome da Instituição</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputName">Nome</label>
                        <input type="text" class="form-control rounded-borders" id="inputName" placeholder="Nome Completo da Instituição" required>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Nome Modal-->
    <!-- Ano Letivo Modal -->
    <div class="modal fade " id="anoLetivoModal" tabindex="-1" role="dialog" aria-labelledby="anoLetivoModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="anoLetivoModalTitle">Ano Letivo</h5>
            <a href="#" data-toggle="modal" data-target="#novoanoLetivoModal" title="Adicionar novo ano letivo"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <a href="#">
                            <div class="modal-menu-lista rounded-borders col-md-2 bg-white outline">
                                <h5 class="p-2 text-dark" href="#">2017</h5>
                            </div>
                        </a>
                        <a href="#">
                            <div class="modal-menu-lista rounded-borders col-md-2 bg-white outline">
                                <h5 class="p-2 text-dark" href="#">2018</h5>
                            </div>
                        </a>
                        <a href="#">
                            <div class="modal-menu-lista rounded-borders col-md-2 bg-white outline">
                                <h5 class="p-2 text-dark" href="#">2019</h5>
                            </div>
                        </a>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Turmas Modal -->
    <!-- Novo Ano Letivo Modal -->
    <div class="modal fade " id="novoanoLetivoModal" tabindex="-1" role="dialog" aria-labelledby="novoanoLetivoModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="novoanoLetivoModalTitle">Novo Ano Letivo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputAnoLetivo">Abo Letivo</label>
                        <input type="number" min="2019" class="form-control rounded-borders" id="inputTurma" placeholder="Digite o ano letivo" required>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Novo Ano Letivo Modal -->
    <!-- Anos Escolares Modal -->
    <div class="modal fade " id="anosEscolaresModal" tabindex="-1" role="dialog" aria-labelledby="anosEscolaresModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="anosEscolaresModalTitle">Anos Escolares</h5>
            <a href="#" data-toggle="modal" data-target="#novoAnoEscolarModal" title="Adicionar novo ano escolar"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <a href="#">
                            <div class="modal-menu-lista rounded-borders col-md-2 bg-white outline">
                                <h5 class="p-2 text-dark" href="#">Jardim I</h5>
                            </div>
                        </a>
                        <a href="#">
                            <div class="modal-menu-lista rounded-borders col-md-2 bg-white outline">
                                <h5 class="p-2 text-dark" href="#">Jardim II</h5>
                            </div>
                        </a>
                        <a href="#">
                            <div class="modal-menu-lista rounded-borders col-md-2 bg-white outline">
                                <h5 class="p-2 text-dark" href="#">1º Ano</h5>
                            </div>
                        </a>
                        <a href="#">
                            <div class="modal-menu-lista rounded-borders col-md-2 bg-white outline">
                                <h5 class="p-2 text-dark" href="#">2º Ano</h5>
                            </div>
                        </a>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Anos Escolares Modal -->
    <!-- Novo Ano Escolar Modal -->
    <div class="modal fade " id="novoAnoEscolarModal" tabindex="-1" role="dialog" aria-labelledby="novoanoEscolarModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="novoanoLetivoModalTitle">Novo Ano Escolar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputAnoEscolar">Ano Escolar</label>
                        <input type="text" class="form-control rounded-borders" id="inputAnoEscolar" placeholder="Digite o ano Escolar a ser adicionado" required>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Novo Ano Escolar Modal -->
    <!-- inep Modal -->
    <div class="modal fade " id="inepModal" tabindex="-1" role="dialog" aria-labelledby="inepModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="inepModalTitle">Número do INEP da Instituição</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputinep">INEP</label>
                        <input type="text" class="form-control rounded-borders" id="inputinep" placeholder="Número do INEP da Instituição" required>
                    </div>
                </div>
                
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM inep Modal -->
@stop