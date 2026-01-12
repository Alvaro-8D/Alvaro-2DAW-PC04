<?php
    function iniciar_sesion($usuario,$password){
        // Funcion principal del programa
        $consulta = conexionBD();

        try {
            if(comprobar_crecenciales($consulta,$usuario,$password)){ //comprueba que usuario y contraseña son correctos
                generar_cookies($consulta,$usuario,$password); // genera las cookies
                header("Location: pe_inicio.php"); // Redirije a la la pagina de "Comprar Producto"
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function comprobar_crecenciales($consulta,$usuario,$password){
        $ok = true;
        $sentencia = $consulta->prepare("SELECT customerNumber,contactLastName
                                        FROM customers
                                        WHERE customerNumber = :usuario 
                                        AND contactLastName = :clave;");
        $sentencia->bindParam(':usuario',$usuario);
        $sentencia->bindParam(':clave',$password);
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll();
        if ($resultado !== array()) {
            $ok = true;
            echo "<h3 style=\"color:#00cc23\">Has Iniciado Sesion CORRECTAMENTE</h3>";
        }else{
            $ok = false;
            echo "<h3 style=\"color:red\">La CONTRASEÑA y/o el USUARIO son INCORRECTOS</h3>";
        }

        $consulta = null;
        return $ok;
    }

    function generar_cookies($consulta,$usuario,$password){
        $sentencia = $consulta->prepare("SELECT customerNumber,customerName
                                        FROM customers
                                        WHERE customerNumber = :usuario
                                        AND contactLastName = :clave;");
        $sentencia->bindParam(':usuario',$usuario);
        $sentencia->bindParam(':clave',$password);
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll();
        // Extrae el NIF del cliente para usar en proximas aplicaciones
        setcookie("id_cliente", $resultado[0]["customerNumber"], time() + (86400 * 30), "/");
        setcookie("nombre", $resultado[0]["customerName"], time() + (86400 * 30), "/");
    }
    
?>