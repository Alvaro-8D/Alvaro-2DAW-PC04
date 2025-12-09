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
  
    function  consultar_almacen($almacen){
        // Funcion principal del programa, ver STOCK de un Almacén
        $consulta = conexionBD();
        try {
            info_almacen($consulta,$almacen); // Mostrar las Categorias de las BD
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function info_almacen($consulta,$almacen){ 
        // Extrae el STOCK de la BD y las muestra por pantalla
    
        //select NOMBRE,CANTIDAD,LOCALIDAD
        //from producto p, almacena a2, almacen a1
        //where a2.NUM_ALMACEN = 1 && a2.ID_PRODUCTO = p.ID_PRODUCTO && a2.NUM_ALMACEN = a1.NUM_ALMACEN;
        
        $sentencia = $consulta->prepare("select NOMBRE,CANTIDAD,LOCALIDAD
                                            from producto p, almacena a2, almacen a1
                                            where a2.NUM_ALMACEN = :num_almacen && a2.ID_PRODUCTO = p.ID_PRODUCTO && a2.NUM_ALMACEN = a1.NUM_ALMACEN;");
        $sentencia->bindParam(':num_almacen',$almacen);
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo

        if($resultado===array()){
            echo "<h2>No hay STOCK en el almacén >>".recuperar_almacen($consulta,$almacen)."<<</h2>";
        }else{
            echo "<h2>Stock del Almacen >>".$resultado[0]["LOCALIDAD"]."<<</h2>";
            foreach ($resultado as $key => $value) {
                echo "<h3>".$value["NOMBRE"]." ===> ".$value["CANTIDAD"]."</h3>";
            }  
        }
        
        $consulta = null;
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