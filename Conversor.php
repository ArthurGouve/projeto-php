<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotação</title>
</head>
<body>
    <main>
        <h1>Conversor de moedas</h1>
            <?php 
//escolhando a quantidade de dias
    $começo = date("m-d-y",strtotime(-5));
    $fim = date("m-d-Y");
        
        $api = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''. $começo .'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
    $real = $_REQUEST["dinhe"] ?? 0;
    $dados =json_decode(file_get_contents($api), true);
    $cotacao = $dados["value"][0]["cotacaoCompra"];
  $dolar = $real / $cotacao;


    $padrao = numfmt_create("pt_BR" ,NumberFormatter::CURRENCY);
        
    echo"<p>Seus " . numfmt_format_currency($padrao ,$real ,"BRL") . "equivalem a <strong>" . numfmt_format_currency($padrao , $dolar ,"USD") . "</strong></p>";
            ?>
            <button onclick="javascript:history.go(-1)">Volte</button>
    </main>
</body>
</html>
