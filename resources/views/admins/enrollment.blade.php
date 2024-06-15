<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | {{$title}}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css')}}">
  </head>
  <style type="text/css">
    body{
      background: #fff;
      font-family: Avenir, sans-serif;
    }
    tr
      {mso-height-source:auto;}
    col
      {mso-width-source:auto;}
    br
      {mso-data-placement:same-cell;}
    .style0
      {mso-number-format:General;
      text-align:general;
      vertical-align:bottom;
      white-space:nowrap;
      mso-rotate:0;
      mso-background-source:auto;
      mso-pattern:auto;
      color:black;
      font-size:11.0pt;
      font-weight:400;
      font-style:normal;
      text-decoration:none;
      font-family:Avenir, sans-serif;
      mso-font-charset:0;
      border:none;
      mso-protection:locked visible;
      mso-style-name:Normal;
      mso-style-id:0;}
    td
      {mso-style-parent:style0;
      padding-top:1px;
      padding-right:1px;
      padding-left:1px;
      mso-ignore:padding;
      color:black;
      font-size:11.0pt;
      font-weight:400;
      font-style:normal;
      text-decoration:none;
      font-family:Avenir, sans-serif;
      mso-font-charset:0;
      mso-number-format:General;
      text-align:general;
      vertical-align:bottom;
      border:none;
      mso-background-source:auto;
      mso-pattern:auto;
      mso-protection:locked visible;
      white-space:nowrap;
      mso-rotate:0;}
    .xl65
      {mso-style-parent:style0;
      font-size:15.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;}
    .xl66
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:right;}
    .xl67
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      background:#FCAD8C;
      mso-pattern:black none;}
    .xl68
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-weight:700;
      font-family:Avenir, monospace;
      mso-font-charset:0;}
    .xl69
      {mso-style-parent:style0;
      font-size:18.0pt;
      font-weight:700;
      font-family:Avenir, monospace;
      mso-font-charset:0;}
    .xl70
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      mso-number-format:"Short Date";
      text-align:left;}
    .xl71
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:left;}
    .xl72
      {mso-style-parent:style0;
      font-size:8.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:center;
      vertical-align:top;}
    .xl73
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:center;}
    .xl74
      {mso-style-parent:style0;
      font-size:9.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:center;
      vertical-align:top;}
    .xl75
      {mso-style-parent:style0;
      font-size:8.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:left;
      vertical-align:top;}
  </style>
  <body onload="printPage();">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <table border=0 cellpadding=0 cellspacing=0 class="col-md-12">
           <col class=xl65 width=20 span=3 style='width:15pt'>
           <col class=xl65 width=72 style='mso-width-source:userset;mso-width-alt:2633; width:54pt'>
           <col class=xl65 width=20 style='mso-width-source:userset;mso-width-alt:731;  width:15pt'>
           <col class=xl65 width=94 style='mso-width-source:userset;mso-width-alt:3437;  width:71pt'>
           <col class=xl65 width=54 style='mso-width-source:userset;mso-width-alt:1974;  width:41pt'>
           <col class=xl65 width=20 span=5 style='mso-width-source:userset;mso-width-alt:  731;width:15pt'>
           <col class=xl65 width=36 style='mso-width-source:userset;mso-width-alt:1316;  width:27pt'>
           <col class=xl65 width=20 span=8 style='width:15pt'>
           <col class=xl65 width=94 style='mso-width-source:userset;mso-width-alt:3437;  width:71pt'>
           <col class=xl65 width=20 style='width:15pt'>
           <col class=xl65 width=20 span=11 style='width:15pt'>
           <tr height=21 style='height:15.75pt'>
            <td height=21 class=xl67 width=20 style='height:15.75pt;width:15pt'>&nbsp;</td>
            <td class=xl67 width=20 style='width:15pt'>&nbsp;</td>
            <td class=xl65 width=20 style='width:15pt'></td>
            <td class=xl65 colspan=5 width=260 style='mso-ignore:colspan;width:196pt'>{{mb_strtoupper($online_institution_name, mb_internal_encoding())}}</td>
            <td class=xl75 colspan=50 width=260 style='mso-ignore:colspan;width:196pt'></td>
           </tr>
           <tr height=20 style='mso-height-source:userset;height:15.0pt'>
            <td height=20 class=xl67 style='height:15.0pt'>&nbsp;</td>
            <td class=xl67>&nbsp;</td>
            <td class=xl65></td>
            <td class=xl65 colspan=3 style='mso-ignore:colspan'>{{mb_strtoupper($online_institution_city."-".$online_institution_state, mb_internal_encoding())}}</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
           </tr>
           <tr height=20 style='mso-height-source:userset;height:15.0pt'>
            <td height=20 class=xl67 style='height:15.0pt'>&nbsp;</td>
            <td class=xl67>&nbsp;</td>
            <td class=xl65></td>
            <td class=xl65 colspan=3 style='mso-ignore:colspan'>FICHA DE MATRÍCULA</td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
            <td class=xl65></td>
           </tr>
           <tr height=20 style='mso-height-source:userset;height:15.0pt'>
            <td class=xl75 colspan=50 width=260 style='mso-ignore:colspan;width:196pt'>SEINTEGRADO - Sistema Escolar Integrado</td>
           </tr>
           

           <tr height=31 style='height:23.25pt'>
            <td height=31 class=xl69 colspan=50>{{mb_strtoupper($student_data->name, mb_internal_encoding())}}</td>
           </tr>
           <tr height=10 style='mso-height-source:userset;height:0.5pt'>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=10 style='height:15.75pt;mso-ignore:colspan'>Data de Nascimento: {{date("d/m/Y", strtotime($student_data->date_birth))}}</td>
            <td class=xl65 colspan=40 style='mso-ignore:colspan'>Naturalidade: {{$student_data->place_birth}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=7 style='height:15.75pt;mso-ignore:colspan'>Gênero: {{$student_data->gender}}</td>
            <td class=xl65 colspan=15 style='mso-ignore:colspan'>CPF: {{$student_data->cpf}}</td>
            <td class=xl65 colspan=25 style='mso-ignore:colspan'>Cor: {{$student_data->color}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>Mãe: {{$student_data->mother}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>Pai: {{$student_data->father}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>Responsável Legal: {{$student_data->legal_responsable}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>DADOS DA CERTIDÃO DE NASCIMENTO</td>
           </tr>
           <tr height=10 style='mso-height-source:userset;height:0.5pt'>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>Número da matrícula: {{$student_data->matricula_cn}}</td>
           </tr>
           <tr height=22 style='mso-height-source:userset;height:16.5pt'>
            <td height=22 class=xl65 colspan=5 style='height:16.5pt;mso-ignore:colspan'>Termo: {{$student_data->termo}}</td>
            <td class=xl65 colspan=4>Livro: {{$student_data->livro}}</td>
            <td colspan=7 class=xl65>Folha: {{$student_data->folha}}</td>
            <td colspan=10 class=xl65>Data de Registro: {{date("d/m/Y", strtotime($student_data->date_cn))}}</td>
           </tr>
           <tr height=21 style='height:15.75pt'>
           </tr>
           <tr height=21 style='height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>SAÚDE DO ALUNO</td>
           </tr>
           <tr height=10 style='mso-height-source:userset;height:0.5pt'>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>Cartão do SUS: {{$student_data->sus_number}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>Necessidades Especiais: {{$student_data->health_special_needs}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>Problema de Saúde: {{$student_data->health_problem}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>ENDEREÇO</td>
           </tr>
           <tr height=10 style='mso-height-source:userset;height:0.5pt'>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>Rua: {{$student_data->street}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=6 style='height:15.75pt;mso-ignore:colspan'>Quadra: {{$student_data->block}}</td>
            <td class=xl65 colspan=7>Lote: {{$student_data->land_lot}}</td>
            <td class=xl65 colspan=25 style='mso-ignore:colspan'>Bairro: {{$student_data->neighborhood}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>CEP: {{$student_data->zipcode}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>Complemento: {{$student_data->complement}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>DADOS DO(A) REQUERENTE DA MATRÍCULA</td>
           </tr>
           <tr height=10 style='mso-height-source:userset;height:0.5pt'>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>Nome Completo: {{$student_enrollment_data->name}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=10 style='height:15.75pt;mso-ignore:colspan'>CPF: {{$student_enrollment_data->cpf}}</td>
            <td class=xl65 colspan=10>RG: {{$student_enrollment_data->rg}} - {{$student_enrollment_data->rg_emissor}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>Grau de parentesco com o (a) aluno (a): {{$student_enrollment_data->degree_relatedness}}</td>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
           </tr>
           <tr height=21 style='mso-height-source:userset;height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>MATRÍCULA</td>
           </tr>
           <tr height=10 style='mso-height-source:userset;height:0.5pt'>
           </tr>
           <tr height=21 style='height:15.75pt'>
            <td height=21 class=xl65 colspan=10 style='height:15.75pt;mso-ignore:colspan'>Código:  {{$student_enrollment_data->enrollment_code}}</td>
            <td class=xl65 colspan=20 style='mso-ignore:colspan'>Data da Matrícula:  {{date("d/m/Y", strtotime($student_enrollment_data->enrollment_date))}}</td>
           </tr>
           <tr height=20 style='mso-height-source:userset;height:15.0pt'>
            <td height=20 class=xl65 colspan=5 style='height:15.0pt;mso-ignore:colspan'>Turma:  {{$student_enrollment_data->institution_class}}</td>
            <td class=xl65 colspan=12>Ano Letivo:  {{$student_enrollment_data->enrollment_year}}</td>
            <td class=xl65 colspan=20>Número de Matrícula:  {{$student_enrollment_data->enrollment_number}}</td>
           </tr>
           <tr height=21 style='height:15.75pt'>
            <td height=21 class=xl65 colspan=50 style='height:15.75pt;mso-ignore:colspan'>Colaborador que fez a matrícula:  {{$student_enrollment_collaborator->name}}</td>
           </tr>
           <tr height=22 style='mso-height-source:userset;height:16.5pt'>
           </tr>
           <tr height=22 style='mso-height-source:userset;height:16.5pt'>
            <td height=22 class=xl65 colspan=50 style='height:16.5pt;mso-ignore:colspan'>CONTATO</td>
           </tr>
           <tr height=9 style='mso-height-source:userset;height:0.75pt'>
           </tr>
           <tr height=22 style='mso-height-source:userset;height:16.5pt'>
            <td height=22 class=xl65 colspan=7 style='height:16.5pt;mso-ignore:colspan'>Tel. 1: {{$student_data->phone1}}</td>
            <td class=xl65 colspan=35 style='mso-ignore:colspan'>Responsável pelo Tel. 1: {{$student_data->phone1_responsable}}</td>
           </tr>
           <tr height=22 style='mso-height-source:userset;height:16.5pt'>
            <td height=22 class=xl65 colspan=7 style='height:16.5pt;mso-ignore:colspan'>Tel. 2: {{$student_data->phone2}}</td>
            <td class=xl65 colspan=35 style='mso-ignore:colspan'>Responsável pelo Tel. 2: {{$student_data->phone2_responsable}}</td>
           </tr>
           <tr height=22 style='mso-height-source:userset;height:16.5pt'>
            <td height=22 class=xl65 colspan=7 style='height:16.5pt;mso-ignore:colspan'>Tel. 3: {{$student_data->phone3}}</td>
            <td class=xl65 colspan=35 style='mso-ignore:colspan'>Responsável pelo Tel. 3: {{$student_data->phone3_responsable}}</td>
           </tr>

           <tr height=22 style='mso-height-source:userset;height:16.5pt'>
           </tr>
           <tr height=22 style='mso-height-source:userset;height:16.5pt'>
            <td class=xl65></td>
            <td class=xl65></td>
            <td colspan=12 height=22 class=xl73 style='height:16.5pt'>_______________________________________</td>
            <td colspan=12 class=xl73>_______________________________________</td>
           </tr>
           <tr height=22 style='mso-height-source:userset;height:16.5pt'>
            <td colspan=15 height=22 class=xl74 style='height:16.5pt'>Secretário</td>
            <td colspan=10 class=xl74>Diretor</td>
           </tr>
           <tr height=22 style='mso-height-source:userset;height:16.5pt'>
           </tr>
           <tr height=22 style='mso-height-source:userset;height:16.5pt'>
            <td colspan=50 height=22 class=xl73 style='height:16.5pt'>__________________________________________________________</td>
           </tr>

           <tr height=21 style='page-break-before:always;height:15.75pt'>
            <td colspan=50 height=21 class=xl72 style='height:15.75pt'>Assinatura de {{$student_enrollment_data->name}}<span
            style='mso-spacerun:yes'> </span></td>
           </tr>
          </table>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript">
    function printPage() {
      window.print();
      setTimeout(window.close, 0);
    }
    
  </script>
</html>
