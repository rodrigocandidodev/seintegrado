@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-grid rounded-borders">
                <div class="painel-box display-flex">
                    <div class="col-md-8">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <strong style="font-size: 25px;">{{$student_name}}</strong>
                            </div>
                        </div>
                        <h5>Rematrícula Realizada com Sucesso</h5>
                        
                    </div>
                    <div class="col-md-4 right-side-menu">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <h5 class="text-center">Exportar Ficha</h5>
                                <hr>
                            </div>
                            
                            <div class="menu-lista col-md-4 text-center bg-orange rounded-borders" title="Exportar como Planilha do Excel">
                                <a class="text-muted" target="_blank" href="{{route('admin.show.student.data.excel',['id' => $student_id, 'year' => $enrollment_year])}}">
                                    <h1 class="margin-top-10 text-white">X</h1>
                                    <p class="text-white">Excel</p>
                                </a>
                            </div>
                            <div class="menu-lista col-md-4 text-center bg-orange rounded-borders" title="Imprimir Ficha ou salvar como PDF">
                                <a class="text-muted" target="_blank" href="{{route('admin.show.student.data.print',['id' => $student_id, 'year' => $enrollment_year])}}">
                                    <h1 class="margin-top-10 text-white">P</h1>
                                    <p class="text-white">Imprimir</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@stop