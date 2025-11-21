<?php
    function extraerAlmacenes(){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("select * from almacen order by NUM_ALMACEN;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo    
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["NUM_ALMACEN"],"\">",$value["LOCALIDAD"],"</option>";
        }
        $consulta = null;
    }

    function extraerProductos(){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("select * from producto order by id_producto;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo    
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["ID_PRODUCTO"],"\">",$value["NOMBRE"],"</option>";
        }
        $consulta = null;
    }

    function almacenarProducto($almacenamiento,$producto,$cantidad){
        // Funcion principal del programa, da de alta almacenes
        $consulta = conexionBD();
        try {         
            insertar_almacen($consulta,$almacenamiento,$producto,$cantidad); // Inserta el Nuevo Almacen 
            mostrar_inventario($consulta); // Mostrar las Categorias de las BD
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function insertar_almacen($consulta,$almacenamiento,$id_producto,$cantidad){ 
        // Pide el nombre y el ID, e inserta el nuevo producto en el almacen en la BD 
        $sentencia = $consulta->prepare("INSERT INTO almacena (NUM_ALMACEN, ID_PRODUCTO, CANTIDAD) VALUES (:numAlmacen,:id_producto,:cantidad)");
        $sentencia->bindParam(':numAlmacen',$almacenamiento);// variar parte de la consulta SQL
        $sentencia->bindParam(':id_producto',$id_producto);// variar parte de la consulta SQL
        $sentencia->bindParam(':cantidad',$cantidad);// variar parte de la consulta SQL
        $sentencia->execute();// ejecuta la sentencia
        $consulta = null;
    }

    function mostrar_inventario($consulta){ 
        // Extrae los datos de "almacena" de la BD y las muestra por pantalla
        $sentencia = $consulta->prepare("select * from almacena order by NUM_ALMACEN;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        echo "<h2>Inventario</h2>";
        foreach($resultado as $row) {
            echo "Numero Almacen: ".$row["NUM_ALMACEN"]."<br>-> ID del Producto: ".$row["ID_PRODUCTO"];
            echo "<br>-> Cantidad: ".$row["CANTIDAD"]."<br>>>>---------------------------------><br>";
        }
        $consulta = null;
    }
    
?>