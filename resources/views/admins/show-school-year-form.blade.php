@extends('layouts/pages-no-menubar')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="painel-grid rounded-borders">
                    <h3>Ano Letivo</h3>
                    <div class="painel-box">
                        <form action="{{route('admin.store.school-year.submit')}}" method="POST">
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
                                        <label>Escolha o ano Letivo</label>
                                        <input type="number" min="2000" name="year" class="form-control rounded-borders" placeholder="Digite o ano letivo" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@stop