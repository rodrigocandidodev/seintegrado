@extends('layouts/pages-no-menubar')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-grid rounded-borders">
                <div class="painel-box">
                    <form action="{{route('admin.store.job.submit',$current_school_year)}}" method="POST">
                        {!! csrf_field()!!}
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
                                <label for="department_id">Departamento</label>
                                <select class="custom-select form-control  rounded-borders" name="department_id">
                                    @foreach($departments as $data)
                                        <option value="{{$data->id}}">{{$data->department}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="inputjob">Novo Cargo</label>
                                <input type="text" class="form-control rounded-borders" id="inputjob" name="office" placeholder="Cargo" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-md-12">
                                <a href="{{route('logout')}}"><button type="button" class="btn btn-secondary rounded-borders">Cancelar</button></a>
                                <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@stop