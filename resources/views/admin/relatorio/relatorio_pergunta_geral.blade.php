<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Relatório geral por pergunta</title>
    <style type="text/css">
        @page {
            margin: 90px 94px 50px 94px;
        }

        table {
            border-collapse: collapse; /* CSS2 */
            background: #ffffff;
        }

        table td {
            border: 1px solid black;
        }

        table th {
            border: 1px solid black;
            background: #ffffff;
        }

        .guarnicao, .posicao, .pontuacao, .footer {
            text-align: center;
        }

        p.original_assinado {
            background-color: #ffffff;
            border:1px solid #e60700;
            padding: 10px;
            text-align:justify;
            color: red;
            text-align: center;
        }

        .guarnicao {
            color: red;
        }

        .cabecalho {
            text-align: center;
            font-weight: bold;
            font-size: 13px;
        }

        .topo_tabela {
            padding-left: 2.8em;
        }

        .om {
            padding-left: 1.0em;
        }

        .titulo {
            text-decoration: underline;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
        }

        .logo {
            text-align: center;
        }

        .assinatura{
            font-weight: bold;
        }
        .head{

            background-repeat: no-repeat;
            font-size: 10px;
            text-align: center;
            height: 110px;
            width: 100%;
            position: fixed;
            top: -50px;
            left: 0;
            right: 0;
            margin: auto;
        }
        .center {
            text-align: center;
        }
    </style>

</head>

<body>
<div class="head">
    RELATÓRIO GERAL POR PERGUNTA
</div>
<div class="paginacao">
    <script type='text/php'>

        if (isset($pdf)){
            $pdf->page_text(490, $pdf->get_height() - 825, "{PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
        }


    </script>
</div>
<div class="logo">
    <img src="<?php echo $_SERVER["DOCUMENT_ROOT"] . '/img/brasao.png';?>" width="70px" height="70px">
</div>

<div class="cabecalho">
    MINISTÉRIO DA DEFESA<br>
    EXÉRCITO BRASILEIRO<br>
    COMANDO DA 12ª REGIÃO MILITAR<br>
    REGIÃO MENDONÇA FURTADO<br>
</div>
<div class="titulo">
    RELATÓRIO GERAL POR PERGUNTA
</div>


<table width="100%" border="1px">
    <tr>
        <th colspan="3" class="topo_tabela">Pergunta
            <br>{{strip_tags($pergunta->descricao)}}<br>
        </th>
    </tr>
    <tr>
        <th class="center" style="width: 20%">OM</th>
        <th class="center" style="width: 60%">Resposta</th>
        <th class="center" style="width: 20%">Data</th>

    </tr>
    @foreach($retorno as $om)

            <tr>
                <td class="om">{{$om->sigla}}</td>
                <td class="om">{{strip_tags($om->resposta)}}</td>
                <td class="center">{{$om->data}}</td>

            </tr>

    @endforeach
</table>

</body>
</html>
