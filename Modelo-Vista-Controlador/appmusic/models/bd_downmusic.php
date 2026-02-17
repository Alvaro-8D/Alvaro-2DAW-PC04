<?php
    // Conexión base de datos
    if(file_exists('..\db\conexion_bd.php')){ 
        // Uso un IF por si el fichero desde el que se incluye se encuentra en otra ubicación
        include_once '..\db\conexion_bd.php'; 
    }

    if(file_exists('..\fun_comunes.php')){ 
        // Uso un IF por si el fichero desde el que se incluye se encuentra en otra ubicación
        include_once '..\fun_comunes.php'; 
        // Extrae el nombre de la cookie carrito del cliente que ha iniciado sesion ahora mismo
        $GLOBALS['nombreCarrito'] = nombre_carrito();
    }

    function extraerMusica(){
        // Extrae las Musica de la BD y las muestra en el HTMl
        $sentencia = $GLOBALS['conexion']->prepare("SELECT TrackId, Name, UnitPrice from track;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["TrackId"],"\">",$value["Name"]," >>> ",$value["UnitPrice"]," $</option>";
        }
    }

    function precio_total_compra(){
        // Extrae las Musica de la BD y las muestra en el HTMl
        $carrito = unserialize($_COOKIE[$GLOBALS['nombreCarrito']]);
        $suma = 0;
        foreach ($carrito as $id => $cantidad) {
            $sentencia = $GLOBALS['conexion']->prepare("SELECT UnitPrice from track where TrackId = :trackId;");
            $sentencia->bindParam(':trackId',$id);// ejecuta la sentencia
            $sentencia->execute();// ejecuta la sentencia
            $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
            $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
            
            $suma += $cantidad*$resultado[0]['UnitPrice'];
        }

        return $suma;
    }

    function actualizar_bd(){ 
        try {
            //$GLOBALS['conexion']->beginTransaction();
            // ********************* Insertar Factura "INVOICE" en la BD **************************
            var_dump(nuevo_id());
            // ********************* Insertar Factura "INVOICE_LINE" en la BD **************************
            //$sentencia = $GLOBALS['conexion']->prepare(" UPDATE reservas set estado_pago = 'pagado' where id_reserva = :id_reserva_actual;");
            //$sentencia->bindParam(':id_reserva_actual',$_COOKIE["id_reserva_actual"]);
            //$sentencia->execute();
            $array_carrito = unserialize($_COOKIE[$GLOBALS['nombreCarrito']]);
            var_dump($array_carrito);
            foreach ($array_carrito as $id_vuelo => $cantidad) {
                //restar_productos($cantidad,$id_vuelo); // restar vuelos pagados
                echo "<h3>hola</h3>";
            }
            //$GLOBALS['conexion']->commit();
            // Una vez cambiado el campo "estado_pago" correctamente, eliminamos la cookie
            //setcookie("id_reserva_actual", "", time() - 36000,"/");
            // Borra el carrito en caso de que la operación salga correcta
            setcookie($GLOBALS['nombreCarrito'], serialize(array()), time() + (86400 * 30), "/");
            
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            $GLOBALS['conexion']->rollBack();

        }finally{ 
            $GLOBALS['conexion'] = null;
        }

    }

    function nuevo_id(){ 
        // Devuelve un nuevo ID para la transacción
        $sentencia = $GLOBALS['conexion']->prepare("SELECT max(InvoiceId) maximo from invoice order by InvoiceId;");
        $sentencia->bindParam(':trackId',$id);// ejecuta la sentencia
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
        $nuevo_id = intval($resultado[0]['maximo'])+1;
        return $nuevo_id;
    }
    
?>