@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-grid rounded-borders">
                <div class="painel-box">
                    <form action="{{route('admin.store.teacher.accessdata.submit',$current_school_year)}}" method="POST">
                        {!! csrf_field()!!}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="collaborator_id">Colaborador</label>
                                <select class="custom-select form-control  rounded-borders" name="collaborator_id" readonly>
                                    <option selected value="{{$stored_collaborator_id}}">{{$stored_collaborator_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="email">E-mail</label>
                                <input type="text" class="form-control rounded-borders" id="email" name="email" placeholder="E-mail" required>
                                
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="name">Nome</label>
                                <input type="text" name="name" value="{{$stored_collaborator_name}}" >
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-md-12">
                                <a href="{{route('admin.show.dashboard',$current_school_year)}}"><button type="button" class="btn btn-secondary rounded-borders">Cancelar</button></a>
                                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //Prevent the user go back to the previous page
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
@stop