@extends('layouts/pages')

@section('conteudo')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <!--STICKY-MENU-BAR-->
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-center">
            <div class="dashboard-values rounded-borders  col-2 bg-white outline">
                <a class="p-2 text-dark" href="#"><span>95</span> Clientes</a>
            </div>
            <div class="dashboard-values rounded-borders col-2 bg-white">
                <a class="p-2 text-dark" href="#"><span>95</span> Instituições</a>
            </div>
        </nav>
        <hr>   
    </div>
    <!--GRID-MENU-->
    <div class="container">
        <div class="row">
            <div class="menu-lista col-md-2 text-center bg-white">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#ClientesModal">
                    <h1 class="margin-top-10">Cl</h1>
                    <p>Clientes</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#novoClienteModal">
                    <h1 class="margin-top-10">NCl</h1>
                    <p>Novo Cliente</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#ColaboradoresModal">
                    <h1 class="margin-top-10">Cb</h1>
                    <p>Colaboradores</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#novoColaboradorModal">
                    <h1 class="margin-top-10">NCb</h1>
                    <p>Novo Colaborador</p>
                </a>
            </div>
            <div class="menu-lista col-md-2 text-center bg-white">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#ConfigModal">
                    <h1 class="margin-top-10">Cf</h1>
                    <p>Configurações</p>
                </a>
            </div>
        </div>
    </div>
    <!-- Novo Cliente Modal -->
    <div class="modal fade" id="novoClienteModal" tabindex="-1" role="dialog" aria-labelledby="novoClienteModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="novoClienteModalTitle">Novo Cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
                {!! csrf_field()!!}
                <div class="form-group">
                    <label for="inputName">Nome</label>
                    <input type="text" class="form-control rounded-borders" id="inputName" aria-describedby="NameHelp" placeholder="Nome Completo">
                    <small id="NameHelp" class="form-text text-muted">Nome do Responsável pelo acesso ao sistema.</small>
                </div>
                <div class="form-group">
                    <label for="inputEmail">E-mail</label>
                    <input type="text" class="form-control rounded-borders" id="inputEmail" aria-describedby="emailHelp" placeholder="E-mail">
                    <small id="emailHelp" class="form-text text-muted">Nós não vamos compartilhar seu e-mail com terceiros.</small>
                </div>
                <div class="form-group">
                    <label for="inputUsername">Nome de usuário</label>
                    <input type="text" class="form-control rounded-borders" id="inputUsername" placeholder="Nome de usuário">
                </div>
                <div class="form-group">
                    <label for="inputSenha">Senha</label>
                    <input type="password" class="form-control rounded-borders" id="inputSenha" placeholder="Senha">
                </div>
                <div class="form-group">
                    <label for="inputInstitution">Nome da Instituição</label>
                    <input type="text" class="form-control rounded-borders" id="inputInstitution" placeholder="Nome da Instituição Contratante">
                </div>
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Novo Cliente Modal -->
    <!-- Novo Colaborador Modal -->
    <div class="modal fade" id="novoColaboradorModal" tabindex="-1" role="dialog" aria-labelledby="novoColaboradorModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="novoColaboradorModalTitle">Novo Colaborador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
                {!! csrf_field()!!}
                <div class="form-group">
                    <label for="inputNameAdm">Nome</label>
                    <input type="text" class="form-control rounded-borders" id="inputNameAdm" aria-describedby="NameAdmHelp" placeholder="Nome Completo">
                    <small id="NameAdmHelp" class="form-text text-muted">Nome do Administrador.</small>
                </div>
                <div class="form-group">
                    <label for="inputEmailAdm">E-mail</label>
                    <input type="text" class="form-control rounded-borders" id="inputEmailAdm" aria-describedby="emailHelp" placeholder="E-mail">
                    <small id="emailAdmHelp" class="form-text text-muted">Nós não vamos compartilhar seu e-mail com terceiros.</small>
                </div>
                <div class="form-group">
                    <label for="inputUsernameAdm">Nome de usuário</label>
                    <input type="text" class="form-control rounded-borders" id="inputUsernameAdm" placeholder="Nome de usuário">
                </div>
                <div class="form-group">
                    <label for="inputSenhaAdm">Senha</label>
                    <input type="password" class="form-control rounded-borders" id="inputSenhaAdm" placeholder="Senha">
                </div>

                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn button-orange rounded-borders">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FIM Novo Colaborador Modal -->
    <!-- Clientes Modal -->
    <div class="modal fade" id="ClientesModal" tabindex="-1" role="dialog" aria-labelledby="ClientesModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ClientesModalTitle">Clientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
            </div>
        </div>
      </div>
    </div>
    <!-- FIM Clientes Modal -->
    <!-- Colaboradores Modal -->
    <div class="modal fade" id="ColaboradoresModal" tabindex="-1" role="dialog" aria-labelledby="ColaboradoresModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ColaboradoresModalTitle">Colaboradores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
            </div>
        </div>
      </div>
    </div>
    <!-- FIM Colaboradores Modal -->
    <!-- Config Modal -->
    <div class="modal fade" id="ConfigModal" tabindex="-1" role="dialog" aria-labelledby="ConfigModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ClientesModalTitle">Configurações</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
            </div>
        </div>
      </div>
    </div>
    <!-- FIM Coonfig Modal -->
    
    
@stop