<?php
    function nuevoAlmacen($localidad){
        // Funcion principal del programa, da de alta almacenes
        $consulta = conexionBD();
        try {
            $nuevoID = ultimo_id($consulta); // Genera un Nuevo ID (NO repetido)            
            insertar_almacen($consulta,$localidad,$nuevoID); // Inserta el Nuevo Almacen 
            mostrar_almacen($consulta); // Mostrar las Categorias de las BD
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function ultimo_id($consulta){
        // Extrae el último ID y devuelve un nuevo ID no repetido a partir del último ID
        $sentencia = $consulta->prepare("select max(NUM_ALMACEN) ultimo_id from almacen;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        if($resultado[0]["ultimo_id"] == null){
            $nuevoID = 1;
        }else{
            // saca el útimo id y le suma +1 para generar el siguiente ID
            $nuevoID = $resultado[0]["ultimo_id"]+1; 
        }
        $consulta = null;
        return $nuevoID;
    }

    function insertar_almacen($consulta,$localidad,$nuevoID){ 
        // Pide el ID y la localidad, e inserta el nuevo almacen en la BD 
        $sentencia = $consulta->prepare("INSERT INTO almacen (NUM_ALMACEN, LOCALIDAD) VALUES (:numAlmacen,:localidad)");
        $sentencia->bindParam(':numAlmacen',$nuevoID);// variar parte de la consulta SQL
        $sentencia->bindParam(':localidad',$localidad);// variar parte de la consulta SQL
        $sentencia->execute();// ejecuta la sentencia
        return $nuevoID;
        $consulta = null;
    }

    function mostrar_almacen($consulta){ 
        // Extrae todas los almacenes de la BD y las muestra por pantalla
        $sentencia = $consulta->prepare("select * from almacen order by NUM_ALMACEN;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        echo "<h2>Almacenes</h2>";
        foreach($resultado as $row) {
            echo "Numero Almacen: ".$row["NUM_ALMACEN"]."<br>-> Localidad: ".$row["LOCALIDAD"]."<br>>>>---------------------------------><br>";
        }
        $consulta = null;
    }
    
?>