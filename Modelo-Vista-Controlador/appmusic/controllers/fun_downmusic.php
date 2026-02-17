<?php
    ob_start(); // Soluciona problemas con los "headers"
    // Conexión base de datos
    require_once '..\db\conexion_bd.php'; 
    // Funciones Comunes
    require_once 'fun_comunes.php';
    impide_acceso_sesion_cerrada();
    // Extrae el nombre de la cookie carrito del cliente que ha iniciado sesion ahora mismo
    $GLOBALS['nombreCarrito'] = nombre_carrito();
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
    // Funciones Especicas del Fichero
    require_once '..\models\bd_downmusic.php';
    require_once '..\views\downmusic.php';
    // Añade Boton Comprar (solo si hay productos en el carrito)
    if (isset($_COOKIE[$GLOBALS['nombreCarrito']])&&unserialize($_COOKIE[$GLOBALS['nombreCarrito']])!== array()) {
        peticion_pago(precio_total_compra(),desc_compra());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        if(isset($_POST['carrito'])){
            boton_carrito();
        }
        if(isset($_POST['vaciar'])){
            setcookie($GLOBALS['nombreCarrito'], serialize(array()), time() + (86400 * 30), "/");
            header("Location: fun_downmusic.php");
        }
            
    }

    verCarrito();

// ************************** FUNCIONES ****************************************

    function boton_carrito(){
        // modifica la variable se sesion con nuevos productos del carrito
        if (isset($_COOKIE[$GLOBALS['nombreCarrito']])) {
            $carrito = unserialize($_COOKIE[$GLOBALS['nombreCarrito']]);
        }else{
            $carrito = array();
        }

        $id_cancion = limpiar_campos($_POST['track']);
        $cantidad = intval(limpiar_campos($_POST['cantidad']));
        if ($cantidad >= 1){
            if(array_key_exists($id_cancion,$carrito)){
                $carrito[$id_cancion] = $carrito[$id_cancion] + $cantidad;
            }else{
                $carrito[$id_cancion] = $cantidad;
            }
            setcookie($GLOBALS['nombreCarrito'], serialize($carrito), time() + (86400 * 30), "/");
            header("Location: fun_downmusic.php");
        }else{
            echo "<h3 style=\"color:red\">Debes añadir AL MENOS 1 Producto *</h3>";
        }
    }

    function verCarrito(){
        // Muestra por pantalla el Carrito de la Compra
        if(isset($_COOKIE[$GLOBALS['nombreCarrito']])&&unserialize($_COOKIE[$GLOBALS['nombreCarrito']])!=array()){
            echo "<h2>Carrito de la Compra: </h2>";
            var_dump(unserialize($_COOKIE[$GLOBALS['nombreCarrito']]));
        }
    }

    function peticion_pago($preciototal,$desc){
        // -----------------------------------------------------------------------------
		// Se incluye la librería
		include 'pagos/signatureUtils/signature.php';

		//Datos de configuración
		$version = "HMAC_SHA512_V2";
		$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave de firma de tu TPV Virtual

		// Valores de entrada 
		$fuc = "263100000"; // Numero de Comercio (FUC)
		$terminal = "20"; // Número Terminal de tu TPV
		$moneda = "978"; // euro
		$transactionType = "0"; // tipo redirección
		$order = time();
		$amount = "".(100*$preciototal); // *100 precio a pagar (se pone en * céntimos *)
        //$amount = "1074"; // probar "Pago Denegado"

		$descripcion = $desc; // descripción de la compra (125 caracteres / A-N)

        // URLs
        $currentDir = $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
        $urlOK = "http://". $currentDir."/pagos/pagoCorrecto.php";
		$urlKO = "http://". $currentDir."/pagos/pagoFallidoDenegado.php";
        
		// Se Rellenan los campos
		$data = array(
			"DS_MERCHANT_PRODUCTDESCRIPTION" => $descripcion,
			"DS_MERCHANT_AMOUNT" => $amount,
			"DS_MERCHANT_ORDER" => $order,
			"DS_MERCHANT_MERCHANTCODE" => $fuc,
			"DS_MERCHANT_CURRENCY" => $moneda,
			"DS_MERCHANT_TRANSACTIONTYPE" => $transactionType,
			"DS_MERCHANT_TERMINAL" => $terminal,
			"DS_MERCHANT_URLOK" => $urlOK,
			"DS_MERCHANT_URLKO" => $urlKO
		);

		// Se generan los parámetros de la petición
		$params = Utils::base64_url_encode_safe(json_encode($data));
		$signature = Signature::createMerchantSignature($kc, $params, $order);
        
        // Envia los datos de la compra directamente al formulario para que RedSys los analice y haga la operacion bancaria
        echo "<!-- INICIO DEL FORMULARIO -->
            <form action='https://sis-t.redsys.es:25443/sis/realizarPago' method=\"post\" target=\"_blank\" >

                <!-- ************** Campos para realizar el PAGO ***************** -->
                <input type=\"submit\" value=\"Finalizar Compra\"/></br>

                <!-- Ds_Merchant_SignatureVersion -->
                <input type=\"hidden\" name=\"Ds_SignatureVersion\" value=\"".$version."\"/>
                <!-- Ds_Merchant_MerchantParameters -->
                <input type=\"hidden\" name=\"Ds_MerchantParameters\" value=\"".$params."\"/>
                <!-- Ds_Merchant_Signature -->
                <input type=\"hidden\" name=\"Ds_Signature\" value=\"".$signature."\"/>

            </form>";
	}

    function desc_compra(){
        // Devuelve descripcionde los productos comprados
        $carrito = unserialize($_COOKIE[$GLOBALS['nombreCarrito']]);
        $descripcion = "Musica: \n";
        foreach ($carrito as $id => $cantidad) {
            $descripcion = $descripcion."[".$id."]=>".$cantidad.",,,";
        }
        return $descripcion;
    }

    
?>