<?php include 'funci\fun_comunes.php'; if(impide_acceso_sesion_cerrada()){session_start();ob_start();} include 'funci\fun_vreservas.php';
if(!isset($_COOKIE["carrito"])){setcookie("carrito",serialize(array()), time() + (86400 * 30), "/");}?>
<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Prueba</title>
 </head>
   
 <body>

	
<?php
	function peticion_pago($preciototal,$descripcion){
		// Se incluye la librería
		include 'pagos/signatureUtils/signature.php';

		//Datos de configuración
		$version = "HMAC_SHA512_V2";
		$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave de firma de tu TPV Virtual

		// Valores de entrada 
		$fuc = "263100000"; // Numero de Comercio (FUC)
		$terminal = "12"; // Número Terminal de tu TPV
		$moneda = "978"; // euro
		$transactionType = "0"; // tipo redirección
		$url = "http:\\localhost\\alvaro\\BD-SQL\\reservasvuelos\\pagos\\urlNotificacion.php"; // URL para recibir notificaciones del pago
		$order = time();
		$amount = "".(100*$preciototal); // *100 precio a pagar (se pone en * céntimos *)
		$descripcion = "Libro El Principito"; // descripción de la compra (125 caracteres / A-N)

		$currentUrl = Utils::getCurrentUrl();
		$urlOK = "http:\\localhost\\alvaro\\BD-SQL\\reservasvuelos\\pagos\\pagoCorrecto.php";
		$urlKO = "http:\\localhost\\alvaro\\BD-SQL\\reservasvuelos\\pagos\\pagoFallidoDenegado.php";

		// Se Rellenan los campos
		$data = array(
			"DS_MERCHANT_PRODUCTDESCRIPTION" => $descripcion,
			"DS_MERCHANT_AMOUNT" => $amount,
			"DS_MERCHANT_ORDER" => $order,
			"DS_MERCHANT_MERCHANTCODE" => $fuc,
			"DS_MERCHANT_CURRENCY" => $moneda,
			"DS_MERCHANT_TRANSACTIONTYPE" => $transactionType,
			"DS_MERCHANT_TERMINAL" => $terminal,
			"DS_MERCHANT_MERCHANTURL" => $url,
			"DS_MERCHANT_URLOK" => $urlOK,
			"DS_MERCHANT_URLKO" => $urlKO
		);

		// Se generan los parámetros de la petición
		$params = Utils::base64_url_encode_safe(json_encode($data));
		$signature = Signature::createMerchantSignature($kc, $params, $order);
	}
?>
	<!-- INICIO DEL FORMULARIO -->
	<form action='https://sis-t.redsys.es:25443/sis/realizarPago' method="post" target="_blank" >

		<!-- ************** Campos para realizar el PAGO ***************** -->
		<!-- Ds_Merchant_SignatureVersion -->
		<input type="hidden" name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
		<!-- Ds_Merchant_MerchantParameters -->
		<input type="hidden" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
		<!-- Ds_Merchant_Signature -->
		<input type="hidden" name="Ds_Signature" value="<?php echo $signature; ?>"/></br>
		
		<input type="submit" name="enviar" value="enviar"/></br>

	</form>
	
 
  </body>
   
</html>

