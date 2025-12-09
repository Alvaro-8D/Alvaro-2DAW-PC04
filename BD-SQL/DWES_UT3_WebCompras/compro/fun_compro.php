<?php
    function extraerClientes(){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("select NIF,NOMBRE from cliente order by NIF;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["NIF"],"\">",$value["NOMBRE"],"(",$value["NIF"],")","</option>";
        }
        $consulta = null;
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

    function comprarProducto($dni,$nombre,$apellido,$cp,$direc,$ciudad){
        // Funcion principal del programa, da de alta clientes
        $consulta = conexionBD();
        try {
            //guardar_compra($consulta,$dni,$nombre,$apellido,$cp,$direc,$ciudad);
            mostrar_compras($consulta);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function guardar_compra($consulta,$dni){ 
        // Pide el ID y la localidad, e inserta el nuevo almacen en la BD 
        $sentencia = $consulta->prepare("INSERT into cliente (NIF,NOMBRE,APELLIDO,CP,DIRECCION,CIUDAD) 
                                        values (:dni,:nombre,:apellido,:cp,:direc,:ciudad)");
        $sentencia->bindParam(':dni',$dni);
        $sentencia->execute();// ejecuta la sentencia
        $consulta = null;
    }

    function mostrar_compras($consulta){ 
        // Extrae todas los almacenes de la BD y las muestra por pantalla
        $sentencia = $consulta->prepare("select NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES from compra order by NIF;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        echo "<h2>Compras</h2>";
        var_dump($resultado);
        $consulta = null;
    }
    
?>