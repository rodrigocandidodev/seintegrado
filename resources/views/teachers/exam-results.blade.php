@extends('layouts/pages')

@section('conteudo')

    <div class="container">
        <div class="row">
            <div class="painel-list text-center">
                <h3 class="text-center">{{$exam->exam}} - {{$exam->institution_class}}</h3>
                @if(Session::has('message'))
                    <div id="notification_tab" class="p-3 mb-2 bg-orange text-white text-center rounded-borders">{{ Session::get('message') }}</div>
                @endif
                <br>
                <a class="text-muted" href="{{route('teacher.exams',[
                    'year'          => $current_school_year,
                    'division_id'   => $division_id
                ])}}">Avaliações do {{$division}}</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="painel-list">
                <table class="table table-bordered table-hover bg-white">
                    <thead class="bg-orange text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Nota</th>
                            <th scope="col" colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter=1; ?>
                        @foreach($exam_results as $data)
                            <tr>
                                <th scope="row">{{$counter++}}</th>
                                <td>{{$data['name']}}</td>
                                
                                @if($data['result']=='')
                                    <td>-</td>
                                    <td>-</td>
                                    <td><a href="#" data-toggle="modal" data-target="#newExamResultModal{{$data['id']}}">Lançar</a></td>
                                @else
                                    <td>{{$data['result']}}</td>
                                    <td><a style="color: #f69f8a;" href="#" data-toggle="modal" data-target="#updateExamResultModal{{$data['result_id']}}">Editar</a></td>
                                    <td>-</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- NEW Exams Result Modal -->
    @foreach($exam_results as $data)
        <div class="modal fade " id="newExamResultModal{{$data['id']}}" tabindex="-1" role="dialog" aria-labelledby="newExamResultModal{{$data['id']}}Title" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="newExamResultModal{{$data['id']}}Title">Lançar Nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('teacher.exams.results.submit', [
                    'year'      => $current_school_year,
                    'exam_id'   => $exam->id,
                    'student_id'=> $data['id']
                ])}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12">
                            <small>Aluno</small>
                            <h4>{{$data['name']}}</h4>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputresult">Resultado</label>
                            <input type="number" min="0" step="0.10" class="form-control rounded-borders" name="result" id="inputresult" placeholder="Nota da avaliação"/>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade " id="updateExamResultModal{{$data['result_id']}}" tabindex="-1" role="dialog" aria-labelledby="updateExamResultModal{{$data['result_id']}}Title" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="updateExamResultModal{{$data['result_id']}}Title">Editar Nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('teacher.exams.results.update', [
                    'year'      => $current_school_year,
                    'exam_id'   => $exam->id,
                    'result_id' => $data['result_id']
                ])}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12">
                            <small>Aluno</small>
                            <h4>{{$data['name']}}</h4>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputupdateresult">Resultado</label>
                            <input type="number" min="0" step="0.10" class="form-control rounded-borders" name="result" value="{{$data['result']}}" id="inputupdateresult" placeholder="Nota da avaliação" required />
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary rounded-borders" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn button-orange rounded-borders">Salvar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    @endforeach
@stop
