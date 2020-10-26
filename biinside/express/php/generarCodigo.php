<?php
	require "Picqer\Barcode\BarcodeGenerator.php";
	require "Picqer\Barcode\BarcodeGeneratorPNG.php";
	$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
	echo '<img id="codQR" src="data:image/png;base64,' . base64_encode($generator->getBarcode("BI0011", $generator::TYPE_CODE_93, '2' , '100')) . '">';
?>