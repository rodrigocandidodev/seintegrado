@extends('layouts/pages')

@section('conteudo')
<div class="container">
    <div class="row">
        <div class="painel-list">
            <h3 class="text-center">Grupos de Planejamentos</h3>
            <hr>
        </div>
    </div>
    <?php $counter = 1; ?>
    	@foreach($all_plan_groups_data as $apgd)
    		@if($counter==1)
    			<div class="row">
    		@endif
    		<div class="menu-lista col-md-2 text-center bg-white rounded-borders">
	            <a class="text-muted" href="{{route('teacher.plan.group',['year' => $current_school_year, 'group_id' => $apgd->id])}}">
	                <h1 class="margin-top-10">{{$apgd->abbreviation}}</h1>
	                <p>{{date("d/m", strtotime($apgd->first_day))}} - {{date('d/m', strtotime($apgd->last_day))}}</p>
	            </a>
	        </div>
    		@if($counter%5==0)
    			</div>
    			<?php $counter = 1; ?>
    		@else
    			<?php $counter++; ?>
    		@endif
        @endforeach
</div>
@stop