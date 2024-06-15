@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-grid rounded-borders">
                <div class="painel-box">
                    <form action="{{route('admin.store.collaborator.contacts.submit',$current_school_year)}}" method="POST">
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
                            <div class="form-group col-md-6">
                                <label for="phone1">Telefone 1</label>
                                <input type="text" class="form-control rounded-borders" id="phone1" name="phone1" placeholder="Telefone">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone2">Telefone 2</label>
                                <input type="text" class="form-control rounded-borders" id="phone2" name="phone2" placeholder="Telefone">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <a href="{{route('admin.show.dashboard',$current_school_year)}}"><button type="button" class="btn btn-secondary rounded-borders">Cancelar</button></a>
                            <button type="submit" class="btn button-orange rounded-borders">Continuar</button>
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