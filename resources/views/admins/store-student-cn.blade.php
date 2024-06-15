@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-grid rounded-borders">
                <div class="painel-box">
                    <form action="{{route('admin.store.student.cn.submit',$current_school_year)}}" method="POST">
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
                            <div class="form-group col-md-12">
                                <label for="matricula_cn">Matrícula da Certidão de Nascimento</label>
                                <input type="text" class="form-control rounded-borders" id="matricula_cn" name="matricula_cn" placeholder="Matrícula">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="date_cn">Data da Certidão de Nascimento</label>
                                <input type="date" class="form-control rounded-borders" id="date_cn" name="date_cn">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="termo">Termo</label>
                                <input type="text" class="form-control rounded-borders" id="termo" name="termo" placeholder="Número do Termo sem pontos e traços">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="livro">Livro</label>
                                <input type="text" class="form-control rounded-borders" id="livro" name="livro" placeholder="Livro">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="folha">Folha</label>
                                <input type="text" class="form-control rounded-borders" id="folha" name="folha" placeholder="Folha">
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