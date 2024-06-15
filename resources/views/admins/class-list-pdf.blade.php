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

  <style>
    body{
      background-color: #fff;
    }
    <!--table
      {mso-displayed-decimal-separator:"\,";
      mso-displayed-thousand-separator:"\.";}
    @page
      {margin:.39in .24in .75in .43in;
      mso-header-margin:.31in;
      mso-footer-margin:.12in;}
    -->
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
      font-family:Calibri, sans-serif;
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
      font-family:Calibri, sans-serif;
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
      font-size:17.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;}
    .xl66
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      background:#FCAD8C;
      mso-pattern:black none;}
    .xl67
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-weight:700;
      font-family:Avenir, monospace;
      mso-font-charset:0;}
    .xl68
      {mso-style-parent:style0;
      font-size:24.0pt;
      font-weight:700;
      font-family:Avenir, monospace;
      mso-font-charset:0;}
    .xl69
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      mso-number-format:"Short Date";
      text-align:left;}
    .xl70
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:left;}
    .xl71
      {mso-style-parent:style0;
      font-size:11.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;}
    .xl72
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:right;}
    .xl73
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-weight:700;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:center;
      border-top:.5pt solid #FCAD8C;
      border-right:none;
      border-bottom:1.0pt solid #FCAD8C;
      border-left:none;}
    .xl74
      {mso-style-parent:style0;
      font-size:17.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      border-top:none;
      border-right:none;
      border-bottom:.5pt solid #595959;
      border-left:none;}
    .xl75
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-weight:700;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:left;
      border-top:.5pt solid #FCAD8C;
      border-right:none;
      border-bottom:1.0pt solid #FCAD8C;
      border-left:none;}
    .xl76
      {mso-style-parent:style0;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:left;
      border-top:none;
      border-right:none;
      border-bottom:.5pt solid #595959;
      border-left:none;}
    .xl77
      {mso-style-parent:style0;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:left;
      border-top:.5pt solid #595959;
      border-right:none;
      border-bottom:.5pt solid #595959;
      border-left:none;}
    .xl78
      {mso-style-parent:style0;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:center;
      border-top:none;
      border-right:none;
      border-bottom:.5pt solid #595959;
      border-left:none;}
    .xl79
      {mso-style-parent:style0;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:center;
      border-top:.5pt solid #595959;
      border-right:none;
      border-bottom:.5pt solid #595959;
      border-left:none;}
    .xl80
      {mso-style-parent:style0;
      font-size:12.0pt;
      font-family:Avenir, monospace;
      mso-font-charset:0;
      text-align:center;
      border-top:none;
      border-right:none;
      border-bottom:.5pt solid windowtext;
      border-left:none;}
  </style>

  <body onload="printPage();" class=xl65>
    <table border=0 cellpadding=0 cellspacing=0 width=1422 style='border-collapse:
   collapse;table-layout:fixed;width:1199pt'>
   <col class=xl65 width=29 style='mso-width-source:userset;mso-width-alt:1060;
   width:22pt'>
   <col class=xl65 width=258 style='mso-width-source:userset;mso-width-alt:9435;
   width:194pt'>
   <col class=xl65 width=99 span=3 style='mso-width-source:userset;mso-width-alt:
   3620;width:74pt'>
   <col class=xl65 width=106 span=3 style='mso-width-source:userset;mso-width-alt:
   3876;width:80pt'>
   <col class=xl65 width=20 style='mso-width-source:userset;mso-width-alt:731;
   width:15pt'>
   <col class=xl65 width=20 span=25 style='width:15pt'>
   <tr height=21 style='height:15.75pt'>
    <td height=21 class=xl66 width=29 style='height:15.75pt;width:22pt'>&nbsp;</td>
    <td class=xl65 width=258 style='width:194pt'>{{mb_strtoupper($online_institution_name, mb_internal_encoding())}}</td>
   </tr>
   <tr height=20 style='mso-height-source:userset;height:15.0pt'>
    <td height=20 class=xl66 style='height:15.0pt'>&nbsp;</td>
    <td class=xl65>{{mb_strtoupper($online_institution_city."-".$online_institution_state, mb_internal_encoding())}}</td>
   </tr>
   <tr height=20 style='mso-height-source:userset;height:15.0pt'>
    <td height=20 class=xl66 style='height:15.0pt'>&nbsp;</td>
    <td class=xl65>LISTA DE ALUNOS</td>
   </tr>
   <tr height=20 style='mso-height-source:userset;height:15.0pt'>
    <td height=20 class=xl71 colspan=2 style='height:15.0pt;mso-ignore:colspan'>SEINTEGRADO
    - Sistema Escolar Integrado</td>
   </tr>
   <tr height=10 style='mso-height-source:userset;height:7.5pt'>
   </tr>
   <tr height=31 style='height:23.25pt'>
    <td height=31 class=xl68 colspan=2 style='height:23.25pt;mso-ignore:colspan'>{{mb_strtoupper($class_data->institution_class.' - '.$class_data->beginnig_age.' anos', mb_internal_encoding())}}</td>
   </tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=28 style='mso-height-source:userset;height:21.0pt'>
    <td class=xl73 colspan="1" height=28  style='height:21.0pt'>Nº</td>
    <td class=xl73 colspan="3">Aluno</td>
    <td class=xl73 colspan="2">Nascimento</td>
    <td class=xl73 colspan="2">Matrícula</td>
    <td class=xl73 colspan="7">Transferência</td>
    <td class=xl73 colspan="10">Telefone 1</td>
    <td class=xl73 colspan="9">Telefone 2</td>
    <td class=xl73 colspan="9">Telefone 3</td>
   </tr>
   @foreach($students_data as $sd)
    <tr height=28 style='mso-height-source:userset;height:21.0pt'>
      <td class=xl74 height=28 align=left style='height:21.0pt'>{{++$students_counter}}</td>
      <td class=xl74 colspan="3">{{$sd->name}}</td>
      <td class=xl74 colspan="2" align=center>{{date('d/m/Y',strtotime($sd->date_birth))}}</td>
      <td class=xl74 colspan="2" align=center>{{date('d/m/Y',strtotime($sd->enrollment_date))}}</td>
      @if($sd->transfer_date==null)
        <td class=xl74 colspan="7" align=center></td>
      @else
        <td class=xl74 colspan="7" align=center>{{date('d/m/Y',strtotime($sd->transfer_date))}}</td>
      @endif
      
      <td class=xl74 colspan="10">{{$sd->phone1}}</td>
      <td class=xl74 colspan="9">{{$sd->phone2}}</td>
      <td class=xl74 colspan="10">{{$sd->phone3}}</td>
    </tr>
   @endforeach

   @while($students_counter<35)
    <tr height=28 style='mso-height-source:userset;height:21.0pt'>
      <td height=28 class=xl74 align=right style='height:21.0pt'>{{++$students_counter}}</td>
      <td class=xl74 colspan="3">&nbsp;</td>
      <td class=xl74 colspan="2">&nbsp;</td>
      <td class=xl74 colspan="2">&nbsp;</td>
      <td class=xl74 colspan="7">&nbsp;</td>
      <td class=xl74 colspan="10">&nbsp;</td>
      <td class=xl74 colspan="9">&nbsp;</td>
      <td class=xl74 colspan="10">&nbsp;</td>
    </tr>
   @endwhile
   
   <tr height=21 style='mso-height-source:userset;height:15.75pt'>
    <td height=21 class=xl65 style='height:15.75pt'></td></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'>
    <td height=21 class=xl65 style='height:15.75pt'></td>
    <td class=xl74>Meninos</td>
    <td class=xl74>{{$male_counter}}</td>
    <td class=xl65></td>
    <td class=xl74 colspan="2">Total de alunos</td>
    <td class=xl74>{{$amout_students_active}}</td>
   </tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'>
    <td height=21 class=xl65 style='height:15.75pt'></td>
    <td class=xl74>Meninas</td>
    <td class=xl74>{{$female_counter}}</td>
    <td class=xl65></td>
    <td class=xl74 colspan="2">Transferências</td>
    <td class=xl74>{{$transfered_students_counter}}</td>
   </tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=22 style='mso-height-source:userset;height:16.5pt'></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=21 style='page-break-before:always;mso-height-source:userset;
    height:15.75pt'></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <tr height=21 style='mso-height-source:userset;height:15.75pt'></tr>
   <![if supportMisalignedColumns]>
   <tr height=0 style='display:none'></tr>
   <![endif]>
    </table>
  </body>
  <script type="text/javascript">
    function printPage() {
      window.print();
      setTimeout(window.close, 0);
    }
    
  </script>

</html>
