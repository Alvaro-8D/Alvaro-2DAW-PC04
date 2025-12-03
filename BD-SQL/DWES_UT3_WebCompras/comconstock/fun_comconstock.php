<?php
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
  
    function  consultar_stock($producto,$almacen){
        // Funcion principal del programa, da de alta productos
        $consulta = conexionBD();
        try {
            mostrar_producto($consulta,$producto,$almacen); // Mostrar las Categorias de las BD
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function mostrar_producto($consulta,$producto,$almacen){ 
        // Extrae el STOCK de la BD y las muestra por pantalla
        // select CANTIDAD from almacena where NUM_ALMACEN = 1 && ID_PRODUCTO = 2;
        $sentencia = $consulta->prepare("select CANTIDAD from almacena where NUM_ALMACEN = :id_producto && ID_PRODUCTO = :num_almacen;");
        $sentencia->bindParam(':id_producto',$producto);
        $sentencia->bindParam(':num_almacen',$almacen);
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo

        if($resultado===array()){
            echo "<h2>No hay STOCK de ".recuperar_producto($consulta,$producto)." en el almacén ".recuperar_almacen($consulta,$almacen)."</h2>";
        }else{
            echo "<h2>Almacén: ".recuperar_almacen($consulta,$almacen)."</h2>";  
            echo "<h2>Producto: ".recuperar_producto($consulta,$producto)."</h2>";  
            echo "<h2>Stock: ".$resultado[0]["CANTIDAD"]."</h2>";  
        }
        
        $consulta = null;
    }

    function recuperar_producto($consulta,$producto){ 
        // Recuperar Nombre del Producto
        $sentencia = $consulta->prepare("select NOMBRE from producto where ID_PRODUCTO = :id_producto;");
        $sentencia->bindParam(':id_producto',$producto);
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo

        $consulta = null;
        return $resultado[0]["NOMBRE"];
    }

    function recuperar_almacen($consulta,$almacen){ 
        // Recuperar Nombre del Almacen
        $sentencia = $consulta->prepare("select LOCALIDAD from almacen where NUM_ALMACEN = :num_almacen;");
        $sentencia->bindParam(':num_almacen',$almacen);
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo

        $consulta = null;
        return $resultado[0]["LOCALIDAD"];
    }

?>