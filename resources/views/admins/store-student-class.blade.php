@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-grid rounded-borders">
                <div class="painel-box">
                    <form action="{{route('admin.store.student.class.submit',$current_school_year)}}" method="POST">
                        {!! csrf_field()!!}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="institution_id">Instituição onde o aluno será matriculado</label>
                                <select class="custom-select form-control  rounded-borders" name="institution_id" readonly>
                                    <option value="{{$online_collaborator_institution_id}}">{{$online_institution_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="student_id">Aluno</label>
                                <select class="custom-select form-control  rounded-borders" name="student_id" readonly>
                                    <option selected value="{{$student_id}}">{{$student_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="enrollment_code">Código da Matrícula</label>
                                <input type="text" class="form-control rounded-borders" id="enrollment_code" name="enrollment_code" value="{{'ava'.$enrollment_year.date('ymd'). $student_id}}" readonly required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="enrollment_date">Data da Matrícula</label>
                                <input type="date" class="form-control rounded-borders" id="enrollment_date" name="enrollment_date" value="{{date('Y-m-d')}}" readonly required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="enrollment_year">Ano Letivo da Matrícula</label>
                                <input type="text" class="form-control rounded-borders" id="enrollment_year" name="enrollment_year" value="{{$enrollment_year}}" readonly required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="enrollment_status_id">Status da Matrícula</label>
                                <select class="custom-select form-control  rounded-borders" name="enrollment_status_id" readonly>
                                    <option selected value="1">Ativa</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="institution_class_id">Turma</label>
                                <select class="custom-select form-control  rounded-borders" name="institution_class_id">
                                    @foreach($all_institution_classes as $classes)
                                        <option selected value="{{$classes->id}}">{{$classes->institution_class}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <h3>Requerente da Matrícula</h3>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control rounded-borders" id="name" name="name" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control rounded-borders" id="cpf" name="cpf" maxlength="14" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="rg">RG</label>
                                <input type="text" class="form-control rounded-borders" id="rg" name="rg">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="rg_emissor">Emissor do RG</label>
                                <input type="text" class="form-control rounded-borders" id="rg_emissor" name="rg_emissor">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="degree_relatedness">Grau de parentesco</label>
                                <input type="text" class="form-control rounded-borders" id="degree_relatedness" name="degree_relatedness" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="collaborator_id">Matrícula realizada por</label>
                                <select class="custom-select form-control  rounded-borders" name="collaborator_id" readonly>
                                    <option selected value="{{$collaborator_id}}">{{$online_collaborator_name}}</option>
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
        var enrollment_year = document.getElementById('enrollment_year');
        console.log(enrollment_year);

        //Prevent the user go back to the previous page
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
@stop