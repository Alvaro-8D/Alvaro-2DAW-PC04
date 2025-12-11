<?php
    function registrarCliente($dni,$nombre,$apellido,$cp,$direc,$ciudad,$clave){
        // Funcion principal del programa, da de alta clientes
        $consulta = conexionBD();
        try {
            insertar_cliente($consulta,$dni,$nombre,$apellido,$cp,$direc,$ciudad,$clave);
            echo "<h3 style=\"color:#00cc23\">Te has Registrado Correctamente   </h3>";
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function dni_repetido($dni,$consulta){ // COMPRUEBA QUE EL dni NO está REPETIDO
        $sentencia = $consulta->prepare("select NIF from cliente order by NIF;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo

        if ($resultado === array()){
            return true;
        }elseif (in_array($dni,array_column($resultado, 'NIF'))){
        // array_column($resultado, 'NIF') >>>> Se encarga de extraer cada DNI del campo NIF de cada array dentro del array padre $resultado
            return false;
        }else{
            return true;
        }
    }

    function dni_correcto($dni,$consulta){
        if(strlen($dni)!=9){
            return false;
        }else{
            $letra = substr($dni,-1);
            $num = str_replace("e","kk:D",(substr($dni,0, strlen($dni)-1))); // evita que detecte "e" como número
            if (is_numeric($num)){$final=true;}else{$final=false;} 
            return ($final && dni_repetido($dni,$consulta));
        }
    }

    function insertar_cliente($consulta,$dni,$nombre,$apellido,$cp,$direc,$ciudad,$clave){ 
        // Pide el ID y la localidad, e inserta el nuevo almacen en la BD 
        $sentencia = $consulta->prepare("INSERT into cliente (NIF,NOMBRE,APELLIDO,CP,DIRECCION,CIUDAD,CLAVE) 
                                        values (:dni,:nombre,:apellido,:cp,:direc,:ciudad,:clave)");
        $sentencia->bindParam(':dni',$dni);
        $sentencia->bindParam(':nombre',$nombre);
        $sentencia->bindParam(':apellido',$apellido);
        $sentencia->bindParam(':cp',$cp);
        $sentencia->bindParam(':direc',$direc);
        $sentencia->bindParam(':ciudad',$ciudad);
        $sentencia->bindParam(':clave',$clave);
        $sentencia->execute();// ejecuta la sentencia
        $consulta = null;
    }
    
?>