<?php
    function iniciar_sesion($nombre,$password){
        // Funcion principal del programa
        $consulta = conexionBD();

        try {
            if(comprobar_crecenciales($consulta,$nombre,$password)){ //comprueba que usuario y contraseña son correctos
                generar_cookies($consulta,$nombre,$password); // genera las cookies
                header("Location: vinicio.php"); // Redirije a la la pagina de "Comprar Producto"
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function comprobar_crecenciales($consulta,$nombre,$password){
        $ok = false;
        $sentencia = $consulta->prepare("SELECT email as NOMBRE,substr(dni,1,4) as CLAVE FROM clientes
                                        WHERE email = :usuario 
                                        AND substr(dni,1,4) = :clave;");
        $sentencia->bindParam(':usuario',$nombre);
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

    function generar_cookies($consulta,$nombre,$password){
        $sentencia = $consulta->prepare("SELECT dni
                                        FROM clientes
                                        WHERE email = :usuario 
                                        AND substr(dni,1,4) = :clave;");
        $sentencia->bindParam(':usuario',$nombre);
        $sentencia->bindParam(':clave',$password);
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll();
        // Extrae el DNI del cliente para usar en proximas aplicaciones
        setcookie("id_cliente", $resultado[0]["dni"], time() + (86400 * 30), "/");
    }

    function redirigir_sesion_abierta(){ // al inicio del PHP ==> PRIMERA LINEA
        // Reenvia a la página de Inicio si YA hay sesión iniciada

        // (de momento, solo necesito 'id_cliente', 'PHPSESSID' es más dificil de controlar)
        $mis_cookies = array('id_cliente'); // mis cookies

        $existen_mis_cookies = false; // Se usa para solo dejar pasar si tiene MIS cookies
        
        foreach ($mis_cookies as $key => $value) {
            if (array_key_exists($value,$_COOKIE)) {
                $existen_mis_cookies = true;
            }
        }

        if(isset($_COOKIE)&&$existen_mis_cookies){ob_start(); header("Location: vinicio.php");}

        /* Copiar y pegar esto al inicio: 
                    <?php redirigir_sesion_abierta(); ?>
        */
    }
    
?>