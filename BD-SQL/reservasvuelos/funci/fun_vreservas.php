<?php 

    function extraerVuelos(){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("select id_vuelo,origen,destino,fechahorasalida from vuelos 
                                        WHERE asientos_disponibles > 0 order by id_vuelo;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["id_vuelo"],"\"> Origen: ",$value["origen"],"| Destino: ",$value["destino"],
            "| Fecha Salida: ",$value["fechahorasalida"],"</option>";
        }
        $consulta = null;
    }

    function boton_carrito($boton_carrito,$carrito){
        // modifica la variable se sesion con nuevos productos del carrito
        if ($boton_carrito) {
            $id_vuelo = limpiar_campos($_POST['vuelos']);
            $cantidad = intval(limpiar_campos($_POST['cantidad']));
            if ($cantidad >= 1){
                if(array_key_exists($id_vuelo,$carrito)){
                    $carrito[$id_vuelo] = $carrito[$id_vuelo] + $cantidad;
                }else{
                    $carrito[$id_vuelo] = $cantidad;
                }
                setcookie("carrito", serialize($carrito), time() + (86400 * 30), "/");
                header("Location: vreservas.php");
            }else{
                echo "<h3 style=\"color:red\">Debes añadir AL MENOS 1 Producto *</h3>";
            }
        }
    }

    function verCarrito(){
        // Muestra por pantalla el Carrito de la Compra
        echo "<h2>Carrito de la Compra: </h2>";
        if(isset($_COOKIE["carrito"])&&unserialize($_COOKIE["carrito"])!==array()){var_dump(unserialize($_COOKIE["carrito"]));}
    }

    function boton_comprar($boton_comprar,$carrito){
        if ($boton_comprar) {
            $cliente = $_COOKIE["id_cliente"]; // recupera la Cookie del NIF del Cliente

            if($carrito !== array()){
                //var_dump($cliente,$_SESSION["carrito"]);
                comprarProducto($cliente,unserialize($_COOKIE["carrito"]));
            }else{
                echo "<h3 style=\"color:red\">Debes añadir AL MENOS 1 Producto AL CARRITO para Comprar*</h3>";
            }
        }
    }

    function comprarProducto($cliente,$array_carrito){
        // Funcion principal del programa, compra productos
        $consulta = conexionBD();
        try {
            $stock2 = true;
            foreach ($array_carrito as $id_vuelo => $cantidad) {
                $stock = comprobar_stock($consulta,$id_vuelo,$cantidad); // true = SI hay stock
                if (!$stock){
                    $stock2 = false; // si para un vuelo no hay asientos, CANCELA TODOS
                    echo '<h1>NO HAY ASIENTOS DISPONIBLES</h1>';
                }
            }
            if ($stock2){
                $nuevoID = nuevo_id();
                $consulta->beginTransaction(); // comienza a modificar tablas
                foreach ($array_carrito as $id_vuelo => $cantidad) {
                    guardar_compra($consulta,$id_vuelo,$cantidad,$nuevoID); // registra la compra en la BD
                    //restar_productos($consulta,$cantidad,$id_vuelo); //restar productos comprados del almacen
                }
                $consulta->commit();//guarda los cambios si todo sale bien
            }
            setcookie("carrito", serialize(array()), time() + (86400 * 30), "/");
            //header("Location: vreservas.php");
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            $consulta->rollBack();
        }
        finally{
            $consulta = null;
        }
    }
    

    function comprobar_stock($consulta,$id_vuelo,$cantidad){ 
        // Devuelve  true = SI hay stock
        $sentencia = $consulta->prepare("select asientos_disponibles as total from vuelos 
                                        WHERE id_vuelo = :id_vuelo");
        $sentencia->bindParam(':id_vuelo',$id_vuelo);
        $sentencia->execute();

        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        if($resultado !== array()){
            if ($resultado[0]["total"] < $cantidad){
                $cantidad = false;
            }else{
                $cantidad = true;
            }
        }else{$cantidad = false; echo "<h3 style=\"color:red\">No hay STOCK <br> :(</h3>";}

        $consulta = null;
        return $cantidad;
    }

    function guardar_compra($consulta,$id_vuelo,$num_asientos,$nuevoID){ 
        // Pide el ID y la localidad, e inserta el nuevo almacen en la BD 
        $preciototal = extraerPrecioTotal($id_vuelo,$num_asientos);
        //header("Location: .\\pagos\\ejemploGeneraPet.php");
        /*
        $sentencia = $consulta->prepare("INSERT into reservas 
                                        values (:id_reserva,:id_vuelo,:dni_cliente,:fecha_reserva,:num_asientos,:preciototal)");
        $sentencia->bindParam(':id_reserva',$nuevoID);
        $sentencia->bindParam(':id_vuelo',$id_vuelo);
        $sentencia->bindParam(':dni_cliente',$_COOKIE['id_cliente']);
        $sentencia->bindParam(':fecha_reserva',date("y-m-d H:i:s"));
        $sentencia->bindParam(':num_asientos',$num_asientos);
        $sentencia->bindParam(':preciototal',$preciototal);
        $sentencia->execute();// ejecuta la sentencia
        $consulta = null;
        */
    }

    function extraerPrecioTotal($id_vuelo,$num_asientos){ //suma todas los asientos de un vuelo y devuelve el precio total
        $consulta = conexionBD();
        $sentencia = $consulta->prepare("SELECT precio_asiento from vuelos WHERE id_vuelo = :id_vuelo order by id_vuelo;");
        $sentencia->bindParam(':id_vuelo',$id_vuelo);
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
        $consulta = null;
        $suma_precio = $resultado[0]['precio_asiento'] * $num_asientos;
        return $suma_precio;
    }

    function restar_productos($consulta,$cantidad,$id_vuelo){ 
        
        $sentencia = $consulta->prepare("UPDATE VUELOS
                                        SET asientos_disponibles = asientos_disponibles	- :cantidad
                                        WHERE id_vuelo = :id_vuelo;");
        $sentencia->bindParam(':cantidad',$cantidad);
        $sentencia->bindParam(':id_vuelo',$id_vuelo);
        $sentencia->execute();
        $consulta = null;
    }

    function nuevo_id(){ 
        // Genera un nuevo ID para la nueva reserva que guardar
        $consulta = conexionBD();
        $sentencia = $consulta->prepare("SELECT max(id_reserva) ultimo from reservas order by id_reserva;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        $nuevoID = 'R'.str_pad(intval(substr($resultado[0]['ultimo'],1))+1,4,'0',STR_PAD_LEFT);
        $consulta = null;
        return $nuevoID;
    }

    function elegir_action($boton){
        // devuelve el "PHP_SELF" si solo se usa el CARRITO
        // devuelve el la direccion de RedSys(PAGOS) si se pulsa el boton COMPRAR

       
            // detecta si se pulsa Boton Comprar

            if(!$boton){ 
                echo htmlspecialchars($_SERVER["PHP_SELF"]);
            }else{ 
                echo "https://sis-t.redsys.es:25443/sis/realizarPago";
            }
        
    }




?>