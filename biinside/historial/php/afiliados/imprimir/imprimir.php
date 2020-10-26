<?php

// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [76, 152]]);

if(isset($_POST["numero"])){
    $numero = $_POST["numero"];
}
else $numero = "";

if(isset($_POST["cliente"])){
    $cliente = $_POST["cliente"];
}
else $cliente = "";

if(isset($_POST["tipo"])){
    $tipo = $_POST["tipo"];
}
else $tipo = "";

$html = '
<!DOCTYPE html>
<html lang="ar">
<!-- <html lang="ar"> for arabic only -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Imprimir orden</title>
    <style>
        @media print {
            @page {
                margin: 0 auto;
                sheet-size: 76mm 152mm;
            }
            html {
                direction: rtl;
            }
            html,body{margin:0;padding:0;margin-top:10px;}
            #printContainer {
                width: 250px;
                margin: auto;
                text-align: justify;
            }

           .text-center{text-align: center;}
        }
    </style>
</head>
<body>
<div id="printContainer">
    <h3 id="slogan" style="margin-top:10px;" class="text-center">Orden Comanda</h3>
    <table style="font-size: 9pt; border-collapse: collapse;" cellpadding="8">
        <tr>
            <td>Orden N°:</td>
            <td><b>'. $numero .'</b></td>
        </tr>
        <tr>
            <td>Tipo:</td>
            <td><b>'. $tipo .'</b></td>
        </tr>

        <tr>
            <td>Cliente</td>
            <td><b>'. $cliente .'</b></td>
        </tr>
    </table>
    <hr>

    <table style="font-size: 9pt; border-collapse: collapse;" cellpadding="8">
        <tr>
            <td><b>Detalle</b></td>
            <td><b>Cant.</b></td>
        </tr>
        <tr><td colspan="2"><hr></td></tr>
        <tr>
            <td>Pizza Hawaina con peperoni</td>
            <td>1</td>
        </tr>
        <tr>
            <td>Pizza Hawaina con peperoni</td>
            <td>1</td>
        </tr>
    </table>

    <table style="font-size: 9pt; border-collapse: collapse;" cellpadding="4">
        <tr>
            <td><b>Extra</b></td>
            <td><b>Cant.</b></td>
        </tr>
        <tr><td colspan="2"><hr></td></tr>
        <tr>
            <td>Extra 1</td>
            <td>1</td>
        </tr>
        <tr>
            <td>Extra 2</td>
            <td>1</td>
        </tr>
    </table>

</div>
</body>
</html>

';

echo 1;

?>