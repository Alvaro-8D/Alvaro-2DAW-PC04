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
            $producto = limpiar_campos($_POST['vuelos']);
            $cantidad = intval(limpiar_campos($_POST['cantidad']));
            //var_dump(1111111,$carrito);
    
            if ($cantidad >= 1){
                if(array_key_exists($producto,$carrito)){
                    $carrito[$producto] = $carrito[$producto] + $cantidad;
                }else{
                    $carrito[$producto] = $cantidad;
                }
               // var_dump(1111111,$carrito);
                $_COOKIE["carrito"] = serialize($carrito);
                //var_dump(1111111,unserialize($_COOKIE["carrito"]));
            }else{
                echo "<h3 style=\"color:red\">Debes añadir AL MENOS 1 Producto *</h3>";
            }
                
        }
    }

    function verCarrito(){
        // Muestra por pantalla el Carrito de la Compra
        echo "<h2>Carrito de la Compra: </h2>";
        if(isset($_COOKIE["carrito"])){var_dump(unserialize($_COOKIE["carrito"]));}
    }

    function boton_comprar($boton_comprar,$carrito){
        if ($boton_comprar) {
            $cliente = $_COOKIE["id_cliente"]; // recupera la Cookie del NIF del Cliente

            if($carrito !== array()){
                //var_dump($cliente,$_SESSION["carrito"]);
                comprarProducto($cliente,$_SESSION["carrito"]);
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
            foreach ($array_carrito as $producto => $cantidad) {
                $stock = comprobar_stock($consulta,$producto,$cantidad); // true = SI hay stock
                if (!$stock){
                    $stock2 = false; // si para un vuelo no hay asientos, CANCELA TODOS
                    echo '<h1>NO HAY ASIENTOS DISPONIBLES</h1>';
                }
            }
            if ($stock2){
                foreach ($array_carrito as $producto => $cantidad) {
                    echo '<h1>SIIIIIIIIIIIIi</h1>';
                    //guardar_compra($consulta,$cliente,$producto,$cantidad,$fechaCom); // registra la compra en la BD
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
        $sentencia = $consulta->prepare("select asientos_disponibles as total from vuelos 
                                        WHERE id_vuelo = :producto");
        $sentencia->bindParam(':producto',$producto);
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

    function guardar_compra($consulta,$id_vuelo,$num_asientos,$preciototal){ 
        // Pide el ID y la localidad, e inserta el nuevo almacen en la BD 
        $nuevoID = nuevo_id();
        $sentencia = $consulta->prepare("INSERT into reserva 
                                        values (:id_reserva,:id_vuelo,:dni_cliente,:fecha_reserva,:num_asientos,:preciototal)");
        $sentencia->bindParam(':id_reserva',$nuevoID);
        $sentencia->bindParam(':id_vuelo',$id_vuelo);
        $sentencia->bindParam(':dni_cliente',$_COOKIE['id_cliente']);
        $sentencia->bindParam(':fecha_reserva',date("y-m-d H:i:s"));
        $sentencia->bindParam(':num_asientos',$num_asientos);
        $sentencia->bindParam(':preciototal',$preciototal);
        $sentencia->execute();// ejecuta la sentencia
        $consulta = null;
    }

    function restar_productos($consulta,$cantidad,$producto){ 
        
        $sentencia = $consulta->prepare("UPDATE VUELOS
                                        SET asientos_disponibles = asientos_disponibles	- :cantidad
                                        WHERE id_vuelo = :producto;");
        $sentencia->bindParam(':cantidad',$cantidad);
        $sentencia->bindParam(':producto',$producto);
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









?>