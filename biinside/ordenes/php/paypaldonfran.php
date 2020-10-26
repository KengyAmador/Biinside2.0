<?php /******************---------------- ENCABEZADOS ----------------******************/
    header('Access-Control-Allow-Origin: *'); //CORS
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); //Compartir los metodos
?>
<!DOCTYPE html>
<?php
    if(isset($_POST["afiliado"])){
        $codAfiliado = $_POST["afiliado"];
    }
    else{
        $codAfiliado = "0";
    }

    if(isset($_POST["cliente"])){
        $codCliente = $_POST["cliente"];
    }
    else{
        $codCliente = "0";
    }

    if(isset($_POST["idorden"])){
        $codOrden = $_POST["idorden"];
    }
    else{
        $codOrden = "0";
    }

    if(isset($_POST["precioTotal"])){
        $valorPago = $_POST["precioTotal"];
    }
    else{
        $valorPago = "0.01";
    }

    if(isset($_POST["tipo"])){
        $tipo = $_POST["tipo"];
    }
    else{
        $tipo = "1";
    }
?>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/css-loader/3.3.3/css-loader.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://www.paypal.com/sdk/js?client-id=Af1vsaJCVx5qQltD1ISS-3mrdcF2YesGCMl-HIeUhOjxn5_CwRs3v2QBgfktnMWZ7tw-QVSj_BAOolWG&disable-funding=credit,card"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
        <title>Paypal Pago</title>
    </head>

    <body>  
        <div class="loader loader-default" data-text="Finalizando Compra" id="divLoader"></div>
        <div id="paypal-button-container"></div>
        <script type="text/javascript">
            /*new Noty({
              theme: 'metroui',
              type: 'error',
              text: "Se produjo un error."
            }).show();*/

            var afiliadoX = '<?php echo $codAfiliado; ?>';
            var clienteX = '<?php echo $codCliente; ?>';
            var ordenX = '<?php echo $codOrden; ?>';
            var pagoX = '<?php echo $valorPago; ?>';
            var tipoX = '<?php echo $tipo; ?>';

            paypal.Buttons({
                style: {
                    size: 'responsive'
                },
                funding: {
                    disallowed: [paypal.FUNDING.CARD],
                    disallowed: [ paypal.FUNDING.CREDIT ]
                },
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: pagoX,
                                currency: 'USD'
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    $("#divLoader").addClass("is-active");
                    return actions.order.capture().then(function (details) {
                        //Actualizar Orden Aquí
                        if(tipoX=='1'){
                            console.log(1);
                            //Actualizar la orden
                            $.ajax({
                                dataType: 'json',
                                url: "http://apps.biinsidecr.com/biinside/ordenes/php/actualizarPaypal.php",
                                type: "POST",
                                data: {
                                    'id': ordenX
                                },
                                success: function (data) { //Success si existe una respuesta, no importa cual porque se valida aqui mismo
                                    console.log(data)
                                    //Registrar los datos en BD
                                    $.ajax({
                                        dataType: 'json',
                                        url: "http://apps.biinsidecr.com/biinside/ordenes/php/guardarPaypal.php",
                                        type: "POST",
                                        data: {
                                            'afiliado': afiliadoX,
                                            'cliente': clienteX,
                                            'idOrden': ordenX,
                                            'paypalId': details.id,
                                            'creacion': details.create_time,
                                            'edicion': details.update_time,
                                            'intent': details.intent,
                                            'estado': details.status,
                                            'idComprador': details.payer.payer_id,
                                            'emailComprador': details.payer.email_address,
                                            'paisComprador': details.payer.country_code,
                                            'nombreComprador': details.payer.name.given_name + ' ' + details.payer.name.surname,
                                            'undId': details.purchase_units[0].reference_id,
                                            'undValor': details.purchase_units[0].amount.value,
                                            'undMoneda': details.purchase_units[0].amount.currency_code,
                                            'undEmail': details.purchase_units[0].payee.email_address,
                                            'undMerchant': details.purchase_units[0].payee.merchant_id,
                                            'dirComprador': details.purchase_units[0].shipping.name.full_name,
                                            'dirDireccion': details.purchase_units[0].shipping.address.address_line_1,
                                            'dirPostal': details.purchase_units[0].shipping.address.postal_code,
                                            'dirPais': details.purchase_units[0].shipping.address.country_code,
                                            'pagoEstado': details.purchase_units[0].payments.captures[0].status,
                                            'pagoId': details.purchase_units[0].payments.captures[0].id,
                                            'pagoCapture': details.purchase_units[0].payments.captures[0].final_capture,
                                            'pagoCreacion': details.purchase_units[0].payments.captures[0].create_time,
                                            'pagoEdicion': details.purchase_units[0].payments.captures[0].update_time,
                                            'pagoValor': details.purchase_units[0].payments.captures[0].amount.value,
                                            'pagoMoneda': details.purchase_units[0].payments.captures[0].amount.currency_code,
                                            'tipo': tipoX,
                                        },
                                        success: function (datos) { //Success si existe una respuesta, no importa cual porque se valida aqui mismo
                                            $("#divLoader").removeClass("is-active");
                                            new Noty({
                                              theme: 'metroui',
                                              type: 'success',
                                              layout: 'topCenter',
                                              text: "Su compra se realizo correctamente, puede pulsar el botón de regresar."
                                            }).show();
                                        },
                                        error: function (jqXHR, estado, error) {//Se produce un error si hay un problema con el estado del servidor
                                            $("#divLoader").removeClass("is-active");
                                            new Noty({
                                              theme: 'metroui',
                                              layout: 'topLeft',
                                              type: 'warning',
                                              text: "Se procesó la transacción, pero el pedido no se registró. Notifique al comercio."
                                            }).show();
                                        }
                                    });
                                },
                                error: function (jqXHR, estado, error) {//Se produce un error si hay un problema con el estado del servidor
                                    $("#divLoader").removeClass("is-active");
                                    new Noty({
                                      theme: 'metroui',
                                      layout: 'topLeft',
                                      type: 'warning',
                                      text: "Se procesó la transacción, pero el pedido no se actualizó. Notifique al comercio."
                                    }).show();
                                }
                            });
                        }
                        else if(tipoX=='2'){
                            console.log(2);
                            //Actualizar la orden
                            $.ajax({
                                dataType: 'json',
                                url: "http://apps.biinsidecr.com/biinside/ordenes/php/actualizarPaypalPro.php",
                                type: "POST",
                                data: {
                                    'id': ordenX
                                },
                                success: function (data) { //Success si existe una respuesta, no importa cual porque se valida aqui mismo
                                    console.log(data)
                                    //Registrar los datos en BD
                                    $.ajax({
                                        dataType: 'json',
                                        url: "http://apps.biinsidecr.com/biinside/ordenes/php/guardarPaypal.php",
                                        type: "POST",
                                        data: {
                                            'afiliado': afiliadoX,
                                            'cliente': clienteX,
                                            'idOrden': ordenX,
                                            'paypalId': details.id,
                                            'creacion': details.create_time,
                                            'edicion': details.update_time,
                                            'intent': details.intent,
                                            'estado': details.status,
                                            'idComprador': details.payer.payer_id,
                                            'emailComprador': details.payer.email_address,
                                            'paisComprador': details.payer.country_code,
                                            'nombreComprador': details.payer.name.given_name + ' ' + details.payer.name.surname,
                                            'undId': details.purchase_units[0].reference_id,
                                            'undValor': details.purchase_units[0].amount.value,
                                            'undMoneda': details.purchase_units[0].amount.currency_code,
                                            'undEmail': details.purchase_units[0].payee.email_address,
                                            'undMerchant': details.purchase_units[0].payee.merchant_id,
                                            'dirComprador': details.purchase_units[0].shipping.name.full_name,
                                            'dirDireccion': details.purchase_units[0].shipping.address.address_line_1,
                                            'dirPostal': details.purchase_units[0].shipping.address.postal_code,
                                            'dirPais': details.purchase_units[0].shipping.address.country_code,
                                            'pagoEstado': details.purchase_units[0].payments.captures[0].status,
                                            'pagoId': details.purchase_units[0].payments.captures[0].id,
                                            'pagoCapture': details.purchase_units[0].payments.captures[0].final_capture,
                                            'pagoCreacion': details.purchase_units[0].payments.captures[0].create_time,
                                            'pagoEdicion': details.purchase_units[0].payments.captures[0].update_time,
                                            'pagoValor': details.purchase_units[0].payments.captures[0].amount.value,
                                            'pagoMoneda': details.purchase_units[0].payments.captures[0].amount.currency_code,
                                            'tipo': tipoX,
                                        },
                                        success: function (datos) { //Success si existe una respuesta, no importa cual porque se valida aqui mismo
                                            $("#divLoader").removeClass("is-active");
                                            new Noty({
                                              theme: 'metroui',
                                              type: 'success',
                                              layout: 'topCenter',
                                              text: "Su compra se realizo correctamente, puede pulsar el botón de regresar."
                                            }).show();
                                        },
                                        error: function (jqXHR, estado, error) {//Se produce un error si hay un problema con el estado del servidor
                                            $("#divLoader").removeClass("is-active");
                                            new Noty({
                                              theme: 'metroui',
                                              layout: 'topLeft',
                                              type: 'warning',
                                              text: "Se procesó la transacción, pero el pedido no se registró. Notifique al comercio."
                                            }).show();
                                        }
                                    });
                                },
                                error: function (jqXHR, estado, error) {//Se produce un error si hay un problema con el estado del servidor
                                    $("#divLoader").removeClass("is-active");
                                    new Noty({
                                      theme: 'metroui',
                                      layout: 'topLeft',
                                      type: 'warning',
                                      text: "Se procesó la transacción, pero el pedido no se actualizó. Notifique al comercio."
                                    }).show();
                                }
                            });
                        }
                    });
                }
            }).render('#paypal-button-container');
        </script>
    </body>
</html>