<?php

// Se incluye la librería
include 'signatureUtils/signature.php';

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
$amount = "145";

$currentUrl = Utils::getCurrentUrl();
$urlOK = "http:\\localhost\\alvaro\\BD-SQL\\reservasvuelos\\pagos\\pagoCorrecto.php";
$urlKO = "http:\\localhost\\alvaro\\BD-SQL\\reservasvuelos\\pagos\\pagoFallidoDenegado.php";

// Se Rellenan los campos
$data = array(
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

echo phpversion();
?>
<html lang="es">
	<body>
		<form name="frm" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" target="_blank">
			Ds_Merchant_SignatureVersion <input type="text" name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
			Ds_Merchant_MerchantParameters <input type="text" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
			Ds_Merchant_Signature <input type="text" name="Ds_Signature" value="<?php echo $signature; ?>"/></br>
			<input type="submit" value="Enviar" >
		</form>
	</body>
</html>
