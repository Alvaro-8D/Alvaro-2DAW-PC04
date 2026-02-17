<?php
    // Conexión base de datos
    if(file_exists('..\db\conexion_bd.php')){ 
        // Uso un IF por si el fichero desde el que se incluye se encuentra en otra ubicación
        include_once '..\db\conexion_bd.php'; 
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

    function restar_productos(){ 

        try {
            echo "hola";
            $GLOBALS['conexion']->beginTransaction();/*
            // ********************* Actualizar el campo "estado_pago" **************************
            $sentencia = $GLOBALS['conexion']->prepare(" UPDATE reservas set estado_pago = 'pagado' where id_reserva = :id_reserva_actual;");
            $sentencia->bindParam(':id_reserva_actual',$_COOKIE["id_reserva_actual"]);
            $sentencia->execute();
            $array_carrito = unserialize($_COOKIE['carrito']);
            // ********************* Restar asientos disponibles de los vuelos **************************
            foreach ($array_carrito as $id_vuelo => $cantidad) {
                restar_productos($GLOBALS['conexion'],$cantidad,$id_vuelo); // restar vuelos pagados
            }
            $GLOBALS['conexion']->commit();
            // Una vez cambiado el campo "estado_pago" correctamente, eliminamos la cookie
            setcookie("id_reserva_actual", "", time() - 36000,"/");
            // Borra el carrito en caso de que la operación salga correcta
            setcookie("carrito", serialize(array()), time() + (86400 * 30), "/");*/
            
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            $GLOBALS['conexion']->rollBack();

        }finally{ 
            $GLOBALS['conexion'] = null;
        }
/*
        //resta los vuelos pagados correctamente de la base de datos
        $sentencia = $GLOBALS['conexion']->prepare("UPDATE VUELOS
                                        SET asientos_disponibles = asientos_disponibles	- :cantidad
                                        WHERE id_vuelo = :id_vuelo;");
        $sentencia->bindParam(':cantidad',$cantidad);
        $sentencia->bindParam(':id_vuelo',$id_vuelo);
        $sentencia->execute();
        */
    }

    
?>