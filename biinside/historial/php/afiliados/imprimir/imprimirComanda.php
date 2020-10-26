<?php

// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [76, 152]]);

if(isset($_POST["numero"])){
    $numero = $_POST["numero"];
}
else $numero = "";

if(isset($_POST["codigo"])){
    $codigo = $_POST["codigo"];
}
else $codigo = "";

if(isset($_POST["cliente"])){
    $cliente = $_POST["cliente"];
}
else $cliente = "";

if(isset($_POST["tipo"])){
    $tipo = $_POST["tipo"];
}
else $tipo = "";

if(isset($_POST["fechaRetiro"])){
    $fechaRetiro = $_POST["fechaRetiro"];
}
else $fechaRetiro = "";

if(isset($_POST["telefono"])){
    $telefono = $_POST["telefono"];
}
else $telefono = "";

if(isset($_POST["productosDet"])){
    $productosDet = $_POST["productosDet"];
}
else {$productosDet = array(
    array('Sin productos',0),
);}

if(isset($_POST["productosExt"])){
        $productosExt = $_POST["productosExt"];
}
else {$productosExt = array(
    array('Sin productos',0),
);}

$html = '
<!DOCTYPE html>
<html lang="ar">
<!-- <html lang="ar"> for arabic only -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Imprimir orden (Historial)</title>
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
    <h3 id="slogan" style="margin-top:6px;" class="text-center">Orden Comanda (Historial)</h3>
    <table style="font-size: 9pt; border-collapse: collapse;" cellpadding="6">
        <tr>
            <td>Orden N°:</td>
            <td><b>'. $numero .'</b></td>
        </tr>
        <tr>
            <td>Tipo:</td>
            <td><b>'. $tipo .'</b></td>
        </tr>

        <tr>
            <td>Cliente:</td>
            <td><b>'. $cliente .'</b></td>
        </tr>

        <tr>
            <td>Código Cliente:</td>
            <td><b>'. $codigo .'</b></td>
        </tr>

        <tr>
            <td>Fecha retiro:</td>
            <td><b>'. $fechaRetiro .'</b></td>
        </tr>

        <tr>
            <td>Teléfono:</td>
            <td><b>'. $telefono .'</b></td>
        </tr>

    </table>
    <hr>

    <table style="font-size: 9pt; border-collapse: collapse;" cellpadding="8">
        <tr>
            <td><b>Fila</b></td>
            <td><b>Detalle</b></td>
            <td><b>Cant.</b></td>
        </tr>
        <tr><td colspan="2"><hr></td></tr>
        ';

foreach ($productosDet as $detalle) {
     $html .= '<tr><td>'.$detalle[0].'</td><td>'.$detalle[1].'</td><td>'.$detalle[2].'</td></tr>';
}

$html .=  '</table>

    <table style="font-size: 9pt; border-collapse: collapse;" cellpadding="4">
        <tr>
            <td><b>Extra</b></td>
            <td><b>Cant.</b></td>
            <td><b>Fila Aso.</b></td>
        </tr>
        <tr><td colspan="2"><hr></td></tr>';
    
foreach ($productosExt as $extra) {
    $html .= '<tr><td>'.$extra[0].'</td><td>'.$extra[1].'</td><td>'.$extra[2].'</td></tr>';
}

    
$html .= '</table></div></body></html>';

// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output("comanda.pdf");

echo 1;
?>