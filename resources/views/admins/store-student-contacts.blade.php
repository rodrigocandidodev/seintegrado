@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-grid rounded-borders">
                <div class="painel-box">
                    <form action="{{route('admin.store.student.contacts.submit',$current_school_year)}}" method="POST">
                        {!! csrf_field()!!}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="student_id">Aluno</label>
                                <select class="custom-select form-control  rounded-borders" name="student_id" readonly>
                                    <option selected value="{{$student_id}}">{{$student_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="enrollment_year">Ano Letivo da matrícula</label>
                                <input type="text" class="form-control rounded-borders" id="enrollment_year" name="enrollment_year" placeholder="Ano Letivo" value="{{$enrollment_year}}" readonly required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="phone1">Telefone 1</label>
                                <input type="text" class="form-control rounded-borders" id="phone1" name="phone1" placeholder="Telefone">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="phone1_responsable">Responsável</label>
                                <input type="text" class="form-control rounded-borders" id="phone1_responsable" name="phone1_responsable" placeholder="Responsável">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="phone2">Telefone 2</label>
                                <input type="text" class="form-control rounded-borders" id="phone2" name="phone2" placeholder="Telefone">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="phone2_responsable">Responsável</label>
                                <input type="text" class="form-control rounded-borders" id="phone2_responsable" name="phone2_responsable" placeholder="Responsável">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="phone3">Telefone 3</label>
                                <input type="text" class="form-control rounded-borders" id="phone3" name="phone3" placeholder="Telefone">
                            </div>
                            <div class="form-group col-md-8">
                                <label for="phone3_responsable">Responsável</label>
                                <input type="text" class="form-control rounded-borders" id="phone3_responsable" name="phone3_responsable" placeholder="Responsável">
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