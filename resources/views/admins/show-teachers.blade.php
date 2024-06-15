@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-list">
                <h3 class="text-center">Professores</h3>
                <br>
                <ul class="list-group">
                    <?php $counter=1; ?>
                    @foreach($teachers_data as $data)
                        <a href="{{route('admin.show.collaborator.data',[$current_school_year,$data->collaborator_id])}}">
                            <li class="painel-list-item">
                                <ul class="list-group painel-list-cel">
                                    <span class="badge painel-list-item-index">{{$counter++}}</span>
                                    <li class="list-group-item  painel-list-name-cel">{{$data->name}}</li>
                                </ul>
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
@stop