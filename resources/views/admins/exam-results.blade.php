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
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter=1; ?>
                        @foreach($exam_results as $data)
                            <tr>
                                <th scope="row">{{$counter++}}</th>
                                <td>{{$data['name']}}</td>
                                <td>{{$data['result']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
