<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} | {{$title}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <!-- Stylesheets-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css')}}">
        <link rel="shortcut icon" href="{{url('img/favicon.ico')}}" />
        <!--Icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<style type="text/css">
		body{
			background-color: #fff;
		}
		.margin-top-50{
            margin-top: 50px;
        }
        .margin-top-100{
            margin-top: 100px;
        }
        .margin-top-200{
            margin-top: 200px;
        }
        .margin-left-right-10{
        	margin-right: 100px;
        	margin-left: 100px;
        }
        .bg-orange{
            background-color: #f69f8a;
        }
        .text-white{
            color: #fff;
        }

	</style>
	<body onload="printPage();">
		<div class="container">
	        <div class="row margin-top-50">
	        	<div class="col-md-12 text-center">
	        		<img class="my-0 mr-md-auto font-weight-normal" src="{{ URL::asset('img/logo.png')}}" alt="" width="200" height="55">
	        	</div>
	        </div>
	        <div class="row margin-top-50">
	        	<div class="col-md-12 text-center">
	        		<h4>ESTADO DE(O) {{mb_strtoupper($online_institution_state,mb_internal_encoding())}}</h4>
	        		<h4><strong>INEP - {{$online_institution_inep}} - {{mb_strtoupper($online_institution_name,mb_internal_encoding())}}</strong></h4>
	        	</div>
	        </div>
	        <div class="row margin-top-100">
	        	<div class="col-md-12 text-center">
	        		@if($statement_type == 'ESC')
	        			<h4><strong>DECLARAÇÃO DE ESCOLARIDADE</strong></h4>
	        		@else
	        			@if($statement_type == 'TRF1' OR $statement_type == 'TRF2')
	        				<h4><strong>DECLARAÇÃO DE TRANSFERÊNCIA</strong></h4>
	        			@endif
	        		@endif
	        	</div>
	        </div>
	        <div class="row margin-top-100">
	        	<div class="col-md-12 text-center margin-left-right-10">
	        		@if($statement_type == 'ESC')
	        			@if($student_data->father == null)
	        				<h4>Declaramos para os devidos fins, que o (a) aluno (a) {{$student_data->name}}, filho (a) de {{$student_data->mother}}, nascido (a) no dia {{date("d/m/Y", strtotime($student_data->date_birth))}} na cidade de {{$student_data->place_birth}}, está matriculado (a) no {{$next_institution_class}} no turno {{$student_enrollment_data->school_shifts}} do ano letivo de {{$current_school_year}}.</h4>
	        			@else
	        				<h4>Declaramos para os devidos fins, que o (a) aluno (a) {{$student_data->name}}, filho (a) de {{$student_data->mother}} e {{$student_data->father}} , nascido (a) no dia {{date("d/m/Y", strtotime($student_data->date_birth))}} na cidade de {{$student_data->place_birth}}, está matriculado (a) no  {{$next_institution_class}} no turno {{$student_enrollment_data->school_shifts}} do ano letivo de {{$current_school_year}}.</h4>
	        			@endif
	        		@else
	        			@if($statement_type == 'TRF1')
	        				@if($student_data->father == null)
		        				<h4>Declaramos para os devidos fins, que o (a) aluno (a) {{$student_data->name}}, filho (a) de {{$student_data->mother}}, nascido (a) no dia {{date("d/m/Y", strtotime($student_data->date_birth))}} na cidade de {{$student_data->place_birth}}, requereu sua transferência tendo o direito de matricular no {{$next_institution_class}}.</h4>
		        			@else
		        				<h4>Declaramos para os devidos fins, que o (a) aluno (a) {{$student_data->name}}, filho (a) de {{$student_data->mother}} e {{$student_data->father}} , nascido (a) no dia {{date("d/m/Y", strtotime($student_data->date_birth))}} na cidade de {{$student_data->place_birth}}, requereu sua transferência tendo o direito de matricular no {{$next_institution_class}}.</h4>
		        			@endif
	        			@else
	        				@if($statement_type == 'TRF2')
	        					@if($student_data->father == null)
			        				<h4>Declaramos para os devidos fins, que o (a) aluno (a) {{$student_data->name}}, filho (a) de {{$student_data->mother}}, nascido (a) no dia {{date("d/m/Y", strtotime($student_data->date_birth))}} na cidade de {{$student_data->place_birth}}, requereu sua transferência tendo o direito de matricular no {{$next_institution_class}}.</h4>
			        			@else
			        				<h4>Declaramos para os devidos fins, que o (a) aluno (a) {{$student_data->name}}, filho (a) de {{$student_data->mother}} e {{$student_data->father}} , nascido (a) no dia {{date("d/m/Y", strtotime($student_data->date_birth))}} na cidade de {{$student_data->place_birth}}, requereu sua transferência tendo o direito de matricular no {{$next_institution_class}}.</h4>
			        			@endif
	        				@endif
	        			@endif
	        		@endif
	        	</div>
	        </div>
	        <div class="row margin-top-200">
	        	<div class="col-md-12 text-center margin-left-right-10">
	        		<h4>Por ser verdade assino a presente declaração.</h4>
	        		<h4>Secretaria do (a) {{$online_institution_name}}, em {{$online_institution_city_state}}.</h4>
	        		<h4>{{date("d/m/Y")}}</h4>
	        	</div>
	        </div>
	        <div class="row margin-top-100">
	        	<div class="col-md-12 text-center margin-left-right-10">
	        		<h4>_______________________________________________</h4>
	        		<h5>{{$online_collaborator_name}}</h5>
	        		<span>{{$online_collaborator_office}}</span>
	        	</div>
	        </div>
	    </div>
	    <footer class="bg-orange margin-top-200">
	    	<div class="col-md-12 text-center text-white">
	    		<span><strong>{{$online_institution_address}} - {{$online_institution_city_state}} | {{$online_institution_phone}} | {{$online_institution_email}}</strong></span>
	    	</div>
	    </footer>
	    <div class="text-center">
	    	<small>SEIntegrado &copy; - Sistema Escolar Integrado</small>
	    </div>
	</body>
	<script type="text/javascript">
    function printPage() {
      window.print();
      setTimeout(window.close, 0);
    }
    
  </script>
</html>