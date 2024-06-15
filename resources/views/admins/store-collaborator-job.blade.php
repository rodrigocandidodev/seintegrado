@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-grid rounded-borders">
                <div class="painel-box">
                    <form action="{{route('admin.store.collaborator.job.submit',$current_school_year)}}" method="POST">
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
                            <div class="form-group col-md-3">
                                <label for="job_year">Ano de Trabalho</label>
                                <input type="text" class="form-control rounded-borders" id="job_year" name="job_year" placeholder="Ano">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="job_status">Status</label>
                                <select class="custom-select form-control  rounded-borders" name="job_status" readonly>
                                    <option selected value="Active">Ativo</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="job_id">Cargo</label>
                                <select class="custom-select form-control  rounded-borders" name="job_id">
                                    @foreach($jobs as $job)
                                        <option value="{{$job->id}}">{{$job->office}}</option>
                                    @endforeach
                                </select>
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