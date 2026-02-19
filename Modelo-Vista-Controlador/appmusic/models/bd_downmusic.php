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
            $GLOBALS['conexion']->beginTransaction();
            // ********************* Insertar Factura "INVOICE" en la BD **************************
            $invoiceId = nuevo_id_1();
            guardar_invoice($invoiceId,$_COOKIE['id_cliente'],precio_total_compra());
            // ********************* Insertar Factura "INVOICE_LINE" en la BD **************************
            $array_carrito = unserialize($_COOKIE[$GLOBALS['nombreCarrito']]);
            $invoiceLineId = intval(nuevo_id_2());
            foreach ($array_carrito as $TrackId => $cantidad) {
                guardar_invoice_line($invoiceLineId,$invoiceId,$TrackId,$cantidad,extraer_UnitPrice($TrackId));
                $invoiceLineId ++;
            }
            $GLOBALS['conexion']->commit();
            // Borra el carrito en caso de que la operación salga correcta
            setcookie($GLOBALS['nombreCarrito'], serialize(array()), time() + (86400 * 30), "/");
            
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            $GLOBALS['conexion']->rollBack();

        }finally{ 
            $GLOBALS['conexion'] = null;
        }

    }

    function nuevo_id_1(){ 
        // Devuelve un nuevo ID para la transacción INVOICE
        $sentencia = $GLOBALS['conexion']->prepare("SELECT max(InvoiceId) maximo from invoice order by InvoiceId;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
        $nuevo_id = intval($resultado[0]['maximo'])+1;
        return $nuevo_id;
    }
    
    function nuevo_id_2(){ 
        // Devuelve un nuevo ID para la transacción INVOICE_LINE
        $sentencia = $GLOBALS['conexion']->prepare("SELECT max(InvoiceLineId) maximo from invoiceline order by InvoiceLineId;");
        $sentencia->execute();// ejecuta la sentencia
        var_dump('1111');
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
        $nuevo_id = intval($resultado[0]['maximo'])+1;
        return $nuevo_id;
    }
    
    function guardar_invoice($invoiceId,$customerId,$precioTotal){ 
        // Pide el ID y la localidad, e inserta el nuevo almacen en la BD 
        $fecha = date("y-m-d H:i:s"); // fecha actual
        $sentencia = $GLOBALS['conexion']->prepare("INSERT into invoice 
                                        (InvoiceId, CustomerId, InvoiceDate, Total)
                                        values (:InvoiceId, :CustomerId, :InvoiceDate, :Total)");
        $sentencia->bindParam(':InvoiceId',$invoiceId);
        $sentencia->bindParam(':CustomerId',$customerId);
        $sentencia->bindParam(':InvoiceDate',$fecha);
        $sentencia->bindParam(':Total',$precioTotal);
        $sentencia->execute();// ejecuta la sentencia
        //$GLOBALS['conexion'] = null;
    }

    function guardar_invoice_line($invoiceLineId,$invoiceId,$TrackId,$Quantity,$UnitPrice){ 
        // Pide el ID y la localidad, e inserta el nuevo almacen en la BD 
        $sentencia = $GLOBALS['conexion']->prepare("INSERT into invoiceline 
                                        (InvoiceLineId, InvoiceId, TrackId, UnitPrice, Quantity)
                                        values (:InvoiceLineId, :InvoiceId, :TrackId, :UnitPrice, :Quantity);");
        $sentencia->bindParam(':InvoiceLineId',$invoiceLineId);
        $sentencia->bindParam(':InvoiceId',$invoiceId);
        $sentencia->bindParam(':TrackId',$TrackId);
        $sentencia->bindParam(':Quantity',$Quantity);
        $sentencia->bindParam(':UnitPrice',$UnitPrice);
        $sentencia->execute();// ejecuta la sentencia
        //$GLOBALS['conexion'] = null;
    }

    function extraer_UnitPrice($TrackId){
        // Extrae el UnitPrice de cada Track
        $sentencia = $GLOBALS['conexion']->prepare("SELECT UnitPrice from track where TrackId = :TrackId;");
        $sentencia->bindParam(':TrackId',$TrackId);
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
        return $resultado[0]['UnitPrice'];
    }
?>