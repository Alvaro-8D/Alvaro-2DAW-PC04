<?php
    function extraerClienteActual($dni){ 
        // Muestra Mensaje de Bienvenida con el nombre y apellido del cliente
        echo "<h2>Hola ",$_COOKIE["nombre"]," ",$_COOKIE["apellido"],"!!! </h2>";
    }

    function extraerProductos(){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("select ID_PRODUCTO,NOMBRE from producto order by id_producto;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo    
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["ID_PRODUCTO"],"\">",$value["NOMBRE"],"</option>";
        }
        $consulta = null;
    }

    function comprarProducto($cliente,$fechaCom,$array_carrito){
        // Funcion principal del programa, compra productos
        $consulta = conexionBD();
        try {
            foreach ($array_carrito as $producto => $cantidad) {
                $stock = comprobar_stock($consulta,$producto,$cantidad); // true = SI hay stock
                if ($stock){
                    guardar_compra($consulta,$cliente,$producto,$cantidad,$fechaCom); // registra la compra en la BD
                    restar_productos($consulta,$cantidad,$producto); //restar productos comprados del almacen
                }
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function comprobar_stock($consulta,$producto,$cantidad){ 
        // Devuelve  true = SI hay stock
        // ESTABA TRATANDO DE QUE DIGA QUÉ PRODUCTO HAY O NO HAY STOCK
        $sentencia = $consulta->prepare("SELECT sum(CANTIDAD) total, NOMBRE from almacena a, producto p
                                        WHERE ID_PRODUCTO = :producto AND p.ID_PRODUCTO = a.ID_PRODUCTO
                                        group by ID_PRODUCTO;");
        $sentencia->bindParam(':producto',$producto);
        $sentencia->execute();

        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        if($resultado !== array()){
            if ($resultado[0]["total"] < $cantidad){
                echo "<h3 style=\"color:red\">No hay STOCK de ",$resultado[0]["NOMBRE"],"<br> :(</h3>";
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
        $sentencia = $consulta->prepare("INSERT into compra (NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES) 
                                        values (:dni,:id_producto,:fechaCom,:unidades)");
        $sentencia->bindParam(':dni',$dni);
        $sentencia->bindParam(':id_producto',$id_producto);
        $sentencia->bindParam(':fechaCom',$fechaCom);
        $sentencia->bindParam(':unidades',$unidades);
        $sentencia->execute();// ejecuta la sentencia
        $consulta = null;
    }

    function restar_productos($consulta,$cantidad,$producto){ 
        // 0. Saca los IDs de todos los almacenes
        $sentencia = $consulta->prepare("select NUM_ALMACEN from almacen order by NUM_ALMACEN;");
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); 
        $almacenes= array_column($sentencia->fetchAll(),"NUM_ALMACEN"); // guardar los IDs de los Almacenes
        // 1. Selecciona un primer almacen 
        // 2. quita los productos del almacen: 
        //      a) NO HAY SUFICIENTE: quita todo
        //      b) SI HAY SUFICIANTE: quita lo justo y necesario
        $alma_actual = 0; // almacen actual
        $productos_restantes = intval($cantidad); //porductos que hay sacar sacando de uno o varios almacenes
        do {
            $sentencia = $consulta->prepare("select CANTIDAD from almacena where NUM_ALMACEN = :alma_actual && id_producto = :producto;");
            $sentencia->bindParam(':alma_actual',$almacenes[$alma_actual]);
            $sentencia->bindParam(':producto',$producto);
            $sentencia->execute();
            $sentencia->setFetchMode(PDO::FETCH_ASSOC); 
            $stock_alm= array_column($sentencia->fetchAll(),"CANTIDAD");
            if($stock_alm !==array()){
                $stock_alm= intval($stock_alm[0]);

                if($stock_alm <= $productos_restantes){
                    /*
                    delete from almacena
                    where num_almacen = 1 && id_producto = 3;
                    */
                    $sentencia = $consulta->prepare("DELETE from almacena
                                                    WHERE num_almacen = :alma_actual && id_producto = :producto;");
                    $sentencia->bindParam(':alma_actual',$almacenes[$alma_actual]);
                    $sentencia->bindParam(':producto',$producto);
                    $sentencia->execute();
                    $productos_restantes = $productos_restantes - $stock_alm;
    
                }else if($stock_alm > $productos_restantes){
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
                }
            }
            // pasar al siguiente almacen
            $alma_actual ++;
            
        }while ($productos_restantes > 0 &&  $alma_actual < count($almacenes));
        // 3. Si (productos_restantes > 0) paso al siguiente almacen (vuelveo al paso 1.)

        
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
    
            if($carrito !== array() && $fechaCom !== ''){
                //var_dump($cliente,$fechaCom,$_SESSION["carrito"]);
                comprarProducto($cliente,$fechaCom,$_SESSION["carrito"]);
            }else{
                echo "<h3 style=\"color:red\">Debes añadir AL MENOS 1 Producto AL CARRITO para Comprar*</h3>";
                echo "<h3 style=\"color:red\">Y tambien DEBES PONER UNA FECHA *</h3>";
            }
        }
    }

    function verCarrito(){
        // Muestra por pantalla el Carrito de la Compra
        echo "<h2>Carrito de la Compra: </h2>";
        var_dump($_SESSION["carrito"]); 
    }
    
?>