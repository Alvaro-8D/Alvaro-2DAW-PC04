<?php
    function registrarCliente($dni,$nombre,$apellido,$cp,$direc,$ciudad){
        // Funcion principal del programa, da de alta clientes
        $consulta = conexionBD();
        try {
            var_dump(dni_correcto($dni));
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function dni_correcto($dni){
        if(strlen($dni)!=9){
            return false;
        }else{
            $letra = substr($dni,-1);
            $num = str_replace("e","kk:D",(substr($dni,0, strlen($dni)-1))); // evita que detecte "e" como número
            if (is_numeric($num)){$final=true;}else{$final=false;} 
            return $final;
        }
    }

    function dni_repetido($dni){

        echo "hola";
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