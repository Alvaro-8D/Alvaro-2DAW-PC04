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
           // mostrar_producto($consulta,$producto,$almacen); // Mostrar las Categorias de las BD
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function mostrar_producto($consulta,$producto,$almacen){ 
        // Extrae todas los Productos de la BD y las muestra por pantalla
        $sentencia = $consulta->prepare("select * from producto order by id_producto;");

        select CANTIDAD 
        from almacena
        where NUM_ALMACEN = :num_almacen && ID_PRODUCTO :id_producto;

        $sentencia->bindParam(':id_producto',$producto);// variar parte de la consulta SQL
        $sentencia->bindParam(':num_almacen',$almacen);// variar parte de la consulta SQL


        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        echo "<h2>Productos</h2>";
        foreach($resultado as $row) {
            echo "Codigo Producto: ".$row["ID_PRODUCTO"]."<br>-> Nombre: ".$row["NOMBRE"]."<br>-> Precio: ";
            echo $row["PRECIO"]."<br>-> Nombre: ".$row["ID_CATEGORIA"]."<br>>>>---------------------------------><br>";
        }
        $consulta = null;
    }
    
?>