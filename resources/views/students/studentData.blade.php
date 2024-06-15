@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-grid rounded-borders">
                <div class="painel-box">
                    <div class="painel-box-header">
                        <h3>Aluno</h3>
                    </div>
                    <hr>
                    <div class="painel-box-body">
                        <h5>Dados Pessoais</h5>
                        <form action="" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputName">Nome</label>
                                    <input type="text" class="form-control rounded-borders" id="inputName" placeholder="Nome Completo do aluno" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputNascimento">Data de Nascimento</label>
                                    <input type="date" class="form-control rounded-borders" id="inputNascimento" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputNaturalidade">Naturalidade</label>
                                    <input type="text" class="form-control rounded-borders" placeholder="Local de Nascimento-UF" required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputUsername">Data da CN</label>
                                    <input type="date" class="form-control rounded-borders" id="inputDataCN">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputTermo">Termo</label>
                                    <input type="text" class="form-control rounded-borders" id="inputTermo" placeholder="Número do Termo">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputLivro">Livro</label>
                                    <input type="text" class="form-control rounded-borders" id="inputLivro" placeholder="Livro">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputFolha">Folha</label>
                                    <input type="text" class="form-control rounded-borders" id="inputFolha" placeholder="Folha">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCN">Matrícula da Certidão de Nascimento</label>
                                    <input type="text" class="form-control rounded-borders" id="inputCN" placeholder="Número da Matrícula da Certidão de Nascimento" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputSus">Número do cartão do SUS</label>
                                    <input type="text" class="form-control rounded-borders" id="inputSus" placeholder="Número do cartão do SUS" >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputGenero">Gênero</label>
                                    <select class="custom-select form-control  rounded-borders" required>
                                        <option selected>Selecione o gênero</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCor">Cor</label>
                                    <select class="custom-select form-control  rounded-borders" required>
                                        <option selected>Selecione a cor</option>
                                        <option value="B">Branca</option>
                                        <option value="N">Negra</option>
                                        <option value="P">Parda</option>
                                        <option value="A">Amarela</option>
                                        <option value="I">Indígena</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCpf">CPF</label>
                                    <input type="text" class="form-control rounded-borders" id="inputCpf" placeholder="CPF">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPai">Pai</label>
                                    <input type="text" class="form-control rounded-borders" id="inputPai" placeholder="Nome Completo do pai" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputMae">Mãe</label>
                                    <input type="text" class="form-control rounded-borders" id="inputMae" placeholder="Nome Completo da mãe" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputRua">Rua</label>
                                    <input type="text" class="form-control rounded-borders" id="inputRua" placeholder="Nome da Rua">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputQuadra">Quadra</label>
                                    <input type="text" class="form-control rounded-borders" id="inputQuadra" placeholder="Quadra">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputLote">Lote</label>
                                    <input type="text" class="form-control rounded-borders" id="inputLote" placeholder="Lote">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputNumero">Número</label>
                                    <input type="text" class="form-control rounded-borders" id="inputNumero" placeholder="Número">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputBairro">Bairro</label>
                                    <input type="text" class="form-control rounded-borders" id="inputBairro" placeholder="Bairro" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCEP">CEP</label>
                                    <input type="text" class="form-control rounded-borders" id="inputCEP" placeholder="CEP" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputComplemento">Complemento</label>
                                    <input type="text" class="form-control rounded-borders" id="inputComplemento" placeholder="Complemento" >
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="inputAutoimagem">
                                <label class="form-check-label" for="inputAutoimagem">Autorizar uso de imagem</label>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEspecial">Necessidade Especial</label>
                                    <input type="text" class="form-control rounded-borders" id="inputEspecial" placeholder="Necessidade Especial" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputSaude">Problema de Saúde</label>
                                    <input type="text" class="form-control rounded-borders" id="inputSaude" placeholder="Problema de Saúde" >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputUsername">Nome de usuário</label>
                                    <input type="text" class="form-control rounded-borders" id="inputUsername" placeholder="Nome de usuário">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputSenha">Senha</label>
                                    <input type="password" class="form-control rounded-borders" id="inputSenha" placeholder="Senha">
                                </div>
                            </div>
                            <hr>
                            <h5 class="modal-title" id="matricularRequerenteModalTitle">Dados do Requerente</h5>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputNameReq">Nome</label>
                                    <input type="text" class="form-control rounded-borders" id="inputNameReq" placeholder="Nome Completo do Requerente" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputNascimentoReq">Data de Nascimento</label>
                                    <input type="date" class="form-control rounded-borders" id="inputNascimentoReq" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputNaturalidadeReq">Naturalidade</label>
                                    <input type="text" id="inputNaturalidadeReq" class="form-control rounded-borders" placeholder="Local de Nascimento-UF" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputGeneroReq">Gênero</label>
                                    <select class="custom-select form-control  rounded-borders" id="inputGeneroReq" required>
                                        <option selected>Selecione o gênero</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputCpfReq">CPF</label>
                                    <input type="text" class="form-control rounded-borders" id="inputCpfReq" placeholder="CPF">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputRG">RG-Emissor</label>
                                    <input type="text" class="form-control rounded-borders" id="inputRG" placeholder="RG-Emissor">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputEstadoCivil">Estado Civil</label>
                                    <select class="custom-select form-control  rounded-borders" id="inputE" required>
                                        <option selected>Selecione</option>
                                        <option value="Solteiro">Solteiro</option>
                                        <option value="Casado">Casado</option>
                                        <option value="Divorciado">Divorciado</option>
                                        <option value="Separado">Separado Judicialmente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputRuaReq">Rua</label>
                                    <input type="text" class="form-control rounded-borders" id="inputRuaReq" placeholder="Nome da Rua">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputQuadraReq">Quadra</label>
                                    <input type="text" class="form-control rounded-borders" id="inputQuadraReq" placeholder="Quadra">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputLoteReq">Lote</label>
                                    <input type="text" class="form-control rounded-borders" id="inputLoteReq" placeholder="Lote">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputNumeroReq">Número</label>
                                    <input type="text" class="form-control rounded-borders" id="inputNumeroReq" placeholder="Número">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputBairroReq">Bairro</label>
                                    <input type="text" class="form-control rounded-borders" id="inputBairroReq" placeholder="Bairro" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCEPReq">CEP</label>
                                    <input type="text" class="form-control rounded-borders" id="inputCEPReq" placeholder="CEP" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputComplementoReq">Complemento</label>
                                    <input type="text" class="form-control rounded-borders" id="inputComplementoReq" placeholder="Complemento" >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputTel1Req">Telefone 1</label>
                                    <input type="text" class="form-control rounded-borders" id="inputTel1Req" placeholder="Telefone com DDD" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputTel2Req">Telefone 2</label>
                                    <input type="text" class="form-control rounded-borders" id="inputTel2Req" placeholder="Telefone com DDD" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputTe3Req">Telefone 3</label>
                                    <input type="text" class="form-control rounded-borders" id="inputTe3Req" placeholder="Telefone com DDD" >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmailReq">E-mail</label>
                                    <input type="email" class="form-control rounded-borders" id="inputEmailReq" placeholder="E-mail" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputParentescoReq">Parentesco</label>
                                    <input type="text" class="form-control rounded-borders" id="inputParentescoReq" placeholder="Grau de Parentesco com o aluno">
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#alterarConfirmarModal">
                                <button type="button" class="btn button-orange rounded-borders">Salvar Alterações</button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Confirmar Alteracoes Modal-->
    <div class="modal fade " id="alterarConfirmarModal" tabindex="-1" role="dialog" aria-labelledby="alterarConfirmarModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="alterarConfirmarModalTitle">Confirmar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5>Você ter certeza?</h5>
            <form action="" method="POST">
                <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn button-orange rounded-borders">Sim</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@stop