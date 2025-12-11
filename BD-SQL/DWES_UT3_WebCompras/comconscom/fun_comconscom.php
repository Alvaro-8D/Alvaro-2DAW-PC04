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
  
    function  compras_de_cliente($cliente,$fecha_inicio,$fecha_fin){
        // Funcion principal del programa, ver compras de un cliente
        $consulta = conexionBD();
        try {
            ver_compras($consulta,$cliente,$fecha_inicio,$fecha_fin); // muestra las compras de ese clientes entre dos fechas
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function ver_compras($consulta,$cliente,$fecha_inicio,$fecha_fin){ 
        // Extrae el STOCK de la BD y las muestra por pantalla
        $sentencia = $consulta->prepare("SELECT CONCAT(' + ',NOMBRE,' (',c.ID_PRODUCTO,') >> ',UNIDADES,' x ',PRECIO,' Euros/unidad = ',PRECIO*UNIDADES)
                                        FROM producto p, compra c
                                        WHERE p.ID_PRODUCTO = c.ID_PRODUCTO AND c.NIF = :cliente 
                                        AND FECHA_COMPRA BETWEEN :fecha_inicio AND :fecha_fin ;");
        $sentencia->bindParam(':cliente',$cliente);
        $sentencia->bindParam(':fecha_inicio',$fecha_inicio);
        $sentencia->bindParam(':fecha_fin',$fecha_fin);
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo

        if($resultado===array()){
            echo "<h2>No hay compras de >>".recuperar_cliente($consulta,$cliente)."<< 
            ente ("") y ()</h2>";
        }else{
            echo "<h2>Stock del Almacen >>".recuperar_cliente($consulta,$cliente)."<<</h2>";
            foreach ($resultado as $key => $value) {
                echo "<h3>".$value["NOMBRE"]." ===> ".$value["CANTIDAD"]."</h3>";
            }  
        }
        
        $consulta = null;
    }

    function recuperar_cliente($consulta,$dni){ 
        // Recuperar Nombre del Almacen
        $sentencia = $consulta->prepare("select NOMBRE from cliente where NIF = :dni;");
        $sentencia->bindParam(':dni',$dni);
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo

        $consulta = null;
        return $resultado[0]["NOMBRE"];
    }

    function suma_de_compras($consulta,$cliente,$fecha_inicio,$fecha_fin){ 
        // Extrae el STOCK de la BD y las muestra por pantalla
        $sentencia = $consulta->prepare("SELECT CONCAT(' + ',NOMBRE,' (',c.ID_PRODUCTO,') >> ',UNIDADES,' x ',PRECIO,' Euros/unidad = ',PRECIO*UNIDADES)
                                        FROM producto p, compra c
                                        WHERE p.ID_PRODUCTO = c.ID_PRODUCTO AND c.NIF = :cliente 
                                        AND FECHA_COMPRA BETWEEN :fecha_inicio AND :fecha_fin ;");
        $sentencia->bindParam(':cliente',$cliente);
        $sentencia->bindParam(':fecha_inicio',$fecha_inicio);
        $sentencia->bindParam(':fecha_fin',$fecha_fin);
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo

        if($resultado===array()){
            echo "<h2>No hay compras de >>".recuperar_cliente($consulta,$cliente)."<< 
            ente ("") y ()</h2>";
        }else{
            echo "<h2>Stock del Almacen >>".recuperar_cliente($consulta,$cliente)."<<</h2>";
            foreach ($resultado as $key => $value) {
                echo "<h3>".$value["NOMBRE"]." ===> ".$value["CANTIDAD"]."</h3>";
            }  
        }
        
        $consulta = null;
    }


?>