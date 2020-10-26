<?php
	include "phpqrcode/qrlib.php";
    // generating 
    QRcode::png($_GET["codigoAfi"], false, QR_ECLEVEL_L, 7, 1); 
?>