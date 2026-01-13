<?php
    function verCarrito(){
        // Muestra por pantalla el Carrito de la Compra
        echo "<h2>Carrito de la Compra: </h2>";
        if(isset($_SESSION["carrito"])){var_dump($_SESSION["carrito"]);}
    }

    function extraerClienteActual(){ 
        // Muestra Mensaje de Bienvenida con el nombre y apellido del cliente
        echo "<h2>Hola ",$_COOKIE["nombre"],"!!! </h2>";
    }

    function extraerProductos(){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("select productCode ,productName from products order by productCode;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo    
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["productCode"],"\">",$value["productName"],"</option>";
        }
        $consulta = null;
    }

    function boton_carrito($boton_carrito,$carrito){
        // modifica la variable se sesion con nuevos productos del carrito
        if ($boton_carrito) {
            $producto = limpiar_campos($_POST['producto']);
            $cantidad = intval(limpiar_campos($_POST['cantidad']));
    
            if ($cantidad >= 1){
                if(array_key_exists($producto,$carrito)){
                    $carrito[$producto] = $carrito[$producto] + $cantidad;
                }else{
                    $carrito[$producto] = $cantidad;
                }
                $_SESSION["carrito"] = $carrito;
    
                //$_SESSION["carrito"] = array();
            }else{
                echo "<h3 style=\"color:red\">Debes añadir AL MENOS 1 Producto *</h3>";
            }
        }
    }

    function boton_comprar($boton_comprar,$carrito){
        if ($boton_comprar) {
            $cliente = $_COOKIE["id_cliente"]; // recupera la Cookie del NIF del Cliente
            $fechaCom = limpiar_campos($_POST['fecha']);

            if(!$fechaCom){$fechaCom = date("Y-m-d"); echo "<h3 style=\"color:BLUE\">Fecha por defecto => HOY *</h3>";}
    
            if($carrito !== array() && $fechaCom !== ''){
                //var_dump($cliente,$fechaCom,$_SESSION["carrito"]);
                comprarProducto($cliente,$fechaCom,$_SESSION["carrito"]);
            }else{
                echo "<h3 style=\"color:red\">Debes añadir AL MENOS 1 Producto AL CARRITO para Comprar*</h3>";
            }
        }
    }


















?>