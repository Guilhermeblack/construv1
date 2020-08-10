<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0087)http://app.valuegaia.com.br/admin/modules/fichas/ficha-captacao-imovel-print.aspx?id=18 -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>Impressão de Ficha</title>
    <script>
        window.print();
        function TABLE1_onclick() { }
    </script>
    <style type="text/css" media="all">
        <!--
        * { font-family: Arial, Helvetica, sans-serif; margin: 0; }
        body {  margin: 5px; }
        h1{ font-size: 14px;}

        p{ line-height: 22px;}
        table { border: 1px solid #000; border-collapse: collapse;font-size: 10px; }
        table tr th { text-align: left; border: 1px solid #000; padding: 4px; font-size: 10px; }
        table tr td { padding: 2px; border: 1px solid #000; }
        .white{ color: #FFF;}
        .detalhes {padding:0px !important; line-height:2 !important; }
        .detalhes li { list-style:none !important; }
        -->
    </style>
</head>
<body style="background-color: #ffffff">
    <table id="TABLE1" onclick="return TABLE1_onclick()">
        
        <tbody><?php include "../dados_corretor.php"; ?>

        <?php include "topo_ficha.php" ?>
        
        <tr>
            <td colspan="6" align="center">
                <h1>
                    Ficha de Captação de Imóvel (Salão) - Data:____/____/____</h1>
            </td>
        </tr>
        <tr>
            <td style="height: 21px">
                Nome do proprietário:
            </td>
            <td colspan="3" style="height: 21px">
                &nbsp;
            </td>
            <td colspan="2" style="height: 21px">
                E-mail:
            </td>
            <!-- <td >&nbsp;</td>-->
        </tr>
        <tr>
            <td>
                Telefones:
            </td>
            <td colspan="5">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="10%" style="height: 16px">
                Valor de venda:
            </td>
            <td width="20%" style="height: 16px">
                &nbsp;
            </td>
            <td width="10%" style="height: 16px">
                Valor de locação:
            </td>
            <td width="20%" style="height: 16px">
                &nbsp;
            </td>
            <td width="10%" style="height: 16px">
                 Padrão: 
            </td>
            <td style="height: 16px; width: 238px;">
                (&nbsp;&nbsp;&nbsp;)Alto (&nbsp;&nbsp;&nbsp;)Baixo (&nbsp;&nbsp;&nbsp;)Médio (&nbsp;&nbsp;&nbsp;)Regular 
            </td>
        </tr>
        <tr>
            <td style="height: 21px">
                Finalidade:
            </td>
            <td style="height: 21px">
                (<span class="white">__</span>)Com&nbsp;(<span class="white">__</span>)Cor&nbsp;
                </td><td style="height: 21px">
                    Financiado?
                </td>
                <td style="height: 21px">
                    (&nbsp;&nbsp;&nbsp;)Sim (&nbsp;&nbsp;&nbsp;)Não
                </td>
                <td style="height: 21px">
                    Localização:
                </td>
                <td style="height: 21px; width: 238px;">
                    (<span class="white">__</span>)Privilegiada&nbsp; (<span class="white">__</span>)Ótima&nbsp;
                    (<span class="white">__</span>)Média&nbsp; (<span class="white">__</span>)Regular
                </td>
        </tr>
        <!--Edificio/ Condominio/ Valor Cond.-->
        <tr>
            <td style="height: 28px">Nome do edifício:</td><td style="height: 28px">&nbsp;</td><td style="height: 28px">Nome do condomínio:</td><td style="height: 28px">&nbsp;</td><td style="height: 28px">R$ Condomínio:</td><td style="height: 28px; width: 238px;"></td>
        </tr>
        <!--Situação/ Ocupado até/ Pelo-->
        <tr>
            <td>Situação do imóvel:</td><td>(&nbsp;&nbsp;&nbsp;)Des (&nbsp;&nbsp;&nbsp; )Ocu (&nbsp;&nbsp;&nbsp;)Res (&nbsp;&nbsp;&nbsp;)Con(&nbsp;&nbsp;&nbsp;)Lan</td><td>Ocupado até:</td><td>____/____/____</td><td>Pelo:</td><td style="width: 238px">(&nbsp;&nbsp;&nbsp;)Prop (&nbsp;&nbsp;&nbsp;)Inq</td>
        </tr>
        <!--autorizado/ Exclusividade/ Inicio Contrato-->
        <tr>
            <td>
                Autorizado p/ negociação?
            </td>
            <td>
                (&nbsp;&nbsp;&nbsp;)Sim (&nbsp;&nbsp;&nbsp;)Não
            </td>
            <td>
                Exclusividade:
            </td>
            <td>
                (&nbsp;&nbsp;&nbsp;)Sim (&nbsp;&nbsp;&nbsp;)Não
            </td>
            <td>
                Início do contrato:
            </td>
            <td style="width: 238px">
                ____/____/____
            </td>
        </tr>
        <!--Validade/ FGTS-->
        <tr>
            <td>
                Validade:
            </td>
            <td>
                _____dias
            </td>
            <td>Usou FGTS nos últimos 3 anos?</td><td>(&nbsp;&nbsp;&nbsp;)Sim (&nbsp;&nbsp;&nbsp;)Não</td>
            <td>
            </td>
            <td style="width: 238px">
            </td>
        </tr>
        <tr>
            <td>Área útil:</td><td>&nbsp;</td>
            <td style="width: 238px">
                Área total:
            </td>
            <td style="width: 11px">
                &nbsp;
            </td>
            <td style="width: 35px" colspan="" rowspan="">Face:</td><td>(&nbsp;&nbsp;&nbsp;)L (&nbsp;&nbsp;&nbsp;)O (&nbsp;&nbsp;&nbsp;)N (&nbsp;&nbsp;&nbsp;)S</td>
        </tr>
        <tr>
            
        </tr>
        
        <tr>
            <td colspan="6">
                <ul class="detalhes"><li><strong>Serviços:</strong>&nbsp;&nbsp;(&nbsp;&nbsp;)Cozinha</li><li><strong>Piso:</strong>&nbsp;&nbsp;(&nbsp;&nbsp;)Piso frio&nbsp;&nbsp;(&nbsp;&nbsp;)Piso elevado&nbsp;&nbsp;(&nbsp;&nbsp;)Aquecido&nbsp;&nbsp;(&nbsp;&nbsp;)Ardósia&nbsp;&nbsp;(&nbsp;&nbsp;)Bloquete&nbsp;&nbsp;(&nbsp;&nbsp;)Carpete&nbsp;&nbsp;(&nbsp;&nbsp;)Carpete de acrílico&nbsp;&nbsp;(&nbsp;&nbsp;)Carpete de madeira&nbsp;&nbsp;(&nbsp;&nbsp;)Carpete de nylon&nbsp;&nbsp;(&nbsp;&nbsp;)Cerâmica&nbsp;&nbsp;(&nbsp;&nbsp;)Cimento queimado&nbsp;&nbsp;(&nbsp;&nbsp;)Contrapiso&nbsp;&nbsp;(&nbsp;&nbsp;)Emborrachado&nbsp;&nbsp;(&nbsp;&nbsp;)Granito&nbsp;&nbsp;(&nbsp;&nbsp;)Laminado&nbsp;&nbsp;(&nbsp;&nbsp;)Mármore&nbsp;&nbsp;(&nbsp;&nbsp;)Porcelanato&nbsp;&nbsp;(&nbsp;&nbsp;)Tábua&nbsp;&nbsp;(&nbsp;&nbsp;)Taco de madeira&nbsp;&nbsp;(&nbsp;&nbsp;)Vinílico</li><li><strong>Íntima:</strong>&nbsp;&nbsp;(&nbsp;&nbsp;)Nº de banheiros</li><li><strong>Social:</strong>&nbsp;&nbsp;(&nbsp;&nbsp;)Nº de salas</li><li><strong>Armários:</strong>&nbsp;&nbsp;(&nbsp;&nbsp;)Cozinha</li><li><strong>Infraestrutura:</strong>&nbsp;&nbsp;(&nbsp;&nbsp;)Nº de andares&nbsp;&nbsp;(&nbsp;&nbsp;)TV a cabo&nbsp;&nbsp;(&nbsp;&nbsp;)Ar condicionado&nbsp;&nbsp;(&nbsp;&nbsp;)Alarme&nbsp;&nbsp;(&nbsp;&nbsp;)Portão eletrônico&nbsp;&nbsp;(&nbsp;&nbsp;)Interfone&nbsp;&nbsp;(&nbsp;&nbsp;)Mezanino&nbsp;&nbsp;(&nbsp;&nbsp;)Área do mezanino&nbsp;&nbsp;(&nbsp;&nbsp;)Imóvel no litoral&nbsp;&nbsp;(&nbsp;&nbsp;)Vista para o mar&nbsp;&nbsp;(&nbsp;&nbsp;)Em costeira/Pé na areia&nbsp;&nbsp;(&nbsp;&nbsp;)Beira Mar&nbsp;&nbsp;(&nbsp;&nbsp;)Metros da praia&nbsp;&nbsp;(&nbsp;&nbsp;)Vagas cobertas&nbsp;&nbsp;(&nbsp;&nbsp;)Vagas descobertas&nbsp;&nbsp;(&nbsp;&nbsp;)Vagas&nbsp;&nbsp; Tipo de vaga: <u>Não informado</u>&nbsp;&nbsp; Característica da vaga: <u>Não informado</u>&nbsp;&nbsp;(&nbsp;&nbsp;)Divisória&nbsp;&nbsp;(&nbsp;&nbsp;)Número de divisórias</li></ul>
            </td>
        </tr>
        <tr>
            <td style="height: 21px">
                Endereço:
            </td>
            <td colspan="3" style="height: 21px">
                &nbsp;
            </td>
            <td style="height: 21px">
                Bairro:
            </td>
            <td style="height: 21px; width: 238px;">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="height: 3px">
                Cidade:
            </td>
            <td style="height: 3px">
                &nbsp;
            </td>
            <td style="height: 3px">
                CEP:
            </td>
            <td style="height: 3px">
                &nbsp;
            </td>
            <td style="height: 3px">
                R$ IPTU:
            </td>
            <td style="height: 3px; width: 238px;">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>
                Local da chave:
            </td>
            <td>&nbsp;</td><td>Ano da construção:</td><td>&nbsp;</td><td>Ano da reforma:</td><td style="width: 238px">&nbsp;</td>
        </tr>
        <tr>
            <td>
                Condição comercial:
            </td>
            <td height="50" colspan="5">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>
                IPTU:
            </td>
            <td>
                &nbsp;
            </td>
            <td>
                Eletricidade:
            </td>
            <td>
                &nbsp;
            </td>
            <td>
                Matrícula:
            </td>
            <td style="width: 238px">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>
                 Água: 
            </td>
            <td>
                 &nbsp; 
            </td>
            <td>
                Placa no local:
            </td>
            <td>
                (&nbsp;&nbsp;&nbsp;) Sim (&nbsp;&nbsp;&nbsp;) Não
            </td>
            <td>
                &nbsp;
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="height: 48px">
                Descrição de anúncios (site e jornal):
            </td>
            <td colspan="5" style="height: 48px">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="height: 57px">
                Comentário Interno:
            </td>
            <td colspan="10" style="height: 57px">
                &nbsp;
            </td>
        </tr>
    </tbody></table>
    <br>
    <center><h1>Autorização de comercialização do imóvel</h1></center><br>    
    <div>
        <span class="Apple-style-span" style="word-spacing: 0px; font: medium &#39;Times New Roman&#39;;
            text-transform: none; color: rgb(0,0,0); text-indent: 0px; white-space: normal;
            letter-spacing: normal; border-collapse: separate; orphans: 2; widows: 2; webkit-border-horizontal-spacing: 0px;
            webkit-border-vertical-spacing: 0px; webkit-text-decorations-in-effect: none;
            webkit-text-size-adjust: auto; webkit-text-stroke-width: 0px">
            <span class="Apple-style-span" style="font-size: 11px; color: rgb(51,51,51); font-family: arial, verdana, helvetica, sans-serif;
                webkit-border-horizontal-spacing: 1px; webkit-border-vertical-spacing: 1px"> <?php include "termo_fim.php"; ?>
                <span style="font-family: Verdana">
                    <span class="Apple-converted-space">&nbsp;</span><br><br><br>
                </span>
                Nome por extenso:________________________________________
                <span style="font-family: Verdana">
                    <span class="Apple-converted-space">&nbsp;</span><br><br>
                </span>
                CPF ou CNPJ:_________________________
                <span style="font-family: Verdana">
                    <span class="Apple-converted-space">&nbsp;</span><br><br>
                </span>
                RG:_________________________
                <span style="font-family: Verdana">
                    <span class="Apple-converted-space">&nbsp;</span><br><br>
                </span>_________________________________
                <span style="font-family: Verdana">
                    <span class="Apple-converted-space">&nbsp;</span><br>
                </span>
                Assinatura
            </span>
        </span>
    </div>


</body></html>