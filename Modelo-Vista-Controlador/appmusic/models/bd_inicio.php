<?php 
    function comprobar_crecenciales($usuario,$password){
        // Comprueba si el usuario y contraseña son corretos
        $ok = true;
        $sentencia = $GLOBALS['conexion']->prepare("SELECT Email,LastName FROM customer WHERE Email = :usuario AND LastName = :clave;");
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

        //$GLOBALS['conexion'] = null;
        return $ok;
    }

    function datos_generar_cookies($usuario,$password){
        // Saca los datos del cliente y se los envia al contolador para pueda crear las cookies
        $sentencia = $GLOBALS['conexion']->prepare("SELECT Email,CustomerId
                                        FROM customer
                                        WHERE Email = :usuario 
                                        AND LastName = :clave;");
        $sentencia->bindParam(':usuario',$usuario);
        $sentencia->bindParam(':clave',$password);
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll();

        // Devuelve ID del Cliente y su Email para meterlo en cookies
        return [$resultado[0]["CustomerId"],$resultado[0]["Email"]];
    }

?>