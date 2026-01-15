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
        $sentencia = $consulta->prepare("select productCode,productName 
                                        from products 
                                        where quantityInStock >=0 
                                        order by productCode;");
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
            $num_pago = limpiar_campos($_POST['num_pago']);

            if($carrito !== array() && $num_pago != ''){
                var_dump($cliente,$num_pago,$_SESSION["carrito"]);
                comprarProducto($cliente,$num_pago,$_SESSION["carrito"]);
            }else{
                echo "<h3 style=\"color:red\">Debes Introducir un NUMERO DE PAGO <br>Y/O<br> añadir AL MENOS
                1 Producto AL CARRITO para Comprar *</h3>";
            }
        }
    }

    function comprarProducto($cliente,$num_pago,$array_carrito){
        // Funcion principal del programa, compra productos
        $consulta = conexionBD();
        try {
            foreach ($array_carrito as $producto => $cantidad) {
                $stock = comprobar_stock($consulta,$producto,$cantidad); // true = SI hay stock
                if ($stock){

                    //*************************************************************** */
                    // Hacer primero "restar productos" y luego " guardar Productos"
                    //*************************************************************** */

                    //guardar_compra($consulta,$cliente,$producto,$cantidad); // registra la compra en la BD
                    restar_productos($consulta,$cantidad,$producto); //restar productos comprados del almacen
                }
            }
            $_SESSION["carrito"] = array();
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function comprobar_stock($consulta,$producto,$cantidad){ 
        // Devuelve  true = SI hay stock
        $sentencia = $consulta->prepare("SELECT quantityInStock total,productName NOMBRE from products
                                             WHERE productCode = :producto;");
        $sentencia->bindParam(':producto',$producto);
        $sentencia->execute();

        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        if($resultado !== array()){
            if ($resultado[0]["total"] < $cantidad){
                echo "<h3 style=\"color:red\">No hay STOCK de [",$resultado[0]["NOMBRE"],"]<br> :(</h3>";
                $cantidad = false;
            }else{
                echo ">>>>>>>>>> Si hay Stock de ",$resultado[0]["NOMBRE"],"<br>";
                $cantidad = true;
            }
        }else{$cantidad = false; echo "<h3 style=\"color:red\">No hay STOCK <br> :(</h3>";}

        $consulta = null;
        return $cantidad;
    }

    function guardar_compra($consulta,$dni,$id_producto,$unidades,$fechaCom){ 
        // Pide el ID y la localidad, e inserta el nuevo almacen en la BD 
        $sentencia = $consulta->prepare("INSERT into  (NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES) 
                                        values (:dni,:id_producto,:fechaCom,:unidades)");
        $sentencia->bindParam(':dni',$dni);
        $sentencia->bindParam(':id_producto',$id_producto);
        $sentencia->bindParam(':fechaCom',$fechaCom);
        $sentencia->bindParam(':unidades',$unidades);
        $sentencia->execute();// ejecuta la sentencia
        $consulta = null;
    }

    function restar_productos($consulta,$cantidad,$producto){ 
        // Resta los Productos Comprados del Stock
        // VOY POR AQUIII
        /*
        update almacena
        set cantidad = 7
        where num_almacen = 1 && id_producto = 1;
        */
        $sentencia = $consulta->prepare("UPDATE almacena
                                        SET cantidad = :stock_restante
                                        WHERE num_almacen = :alma_actual && id_producto = :producto;");
        $sentencia->bindParam(':alma_actual',$almacenes[$alma_actual]);
        $sentencia->bindParam(':producto',$producto);
        $stock_restante = $stock_alm - $productos_restantes;
        $productos_restantes = 0;
        $sentencia->bindParam(':stock_restante',$stock_restante);
        $sentencia->execute();
        $consulta = null;
    }

















?>