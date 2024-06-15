@extends('layouts/pages')

@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="painel-grid rounded-borders">
                <div class="painel-box">
                    <form action="{{route('admin.update.student.address.submit',$current_school_year)}}" method="POST">
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
                                <label for="street">Rua</label>
                                <input type="text" class="form-control rounded-borders" id="street" name="street" placeholder="Rua">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="block">Quadra</label>
                                <input type="text" class="form-control rounded-borders" id="block" name="block" placeholder="Quadra">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="land_lot">Lote</label>
                                <input type="text" class="form-control rounded-borders" id="land_lot" name="land_lot" placeholder="Lote">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="number">Número</label>
                                <input type="text" class="form-control rounded-borders" id="number" name="number" placeholder="Número">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="neighborhood">Bairro</label>
                                <input type="text" class="form-control rounded-borders" id="neighborhood" name="neighborhood" placeholder="Bairro">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="zipcode">CEP</label>
                                <input type="text" class="form-control rounded-borders" id="zipcode" name="zipcode" placeholder="CEP" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="complement">Complemento</label>
                                <input type="text" class="form-control rounded-borders" id="complement" name="complement">
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
    
@stop