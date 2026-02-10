<?php
    require_once 'views\login.php';
    require_once 'controllers\fun_comunes.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        //cerrar_sesion();
        $usuario = limpiar_campos($_POST['usuario']);
        $password = limpiar_campos($_POST['password']);

        var_dump($GLOBALS['conexion']);

        iniciar_sesion($usuario,$password); //realiza todo el programa de Introducir Categorías
    }


    function iniciar_sesion($usuario,$password){
        // Funcion principal del programa

        try {
            if(comprobar_crecenciales($usuario,$password)){ //comprueba que usuario y contraseña son correctos
                generar_cookies($usuario,$password); // genera las cookies
                header("Location: views/inicio.php"); // Redirije a la la pagina de "Comprar Producto"
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        //$GLOBALS['conexion'] = null;
    }

    function comprobar_crecenciales($usuario,$password){
        $ok = true;
        $sentencia = $GLOBALS['conexion']->prepare("SELECT Email,LastName
                                        FROM customer
                                        WHERE Email = :usuario 
                                        AND LastName = :clave;");
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

    function generar_cookies($usuario,$password){
        $sentencia = $GLOBALS['conexion']->prepare("SELECT Email,CustomerId
                                        FROM customer
                                        WHERE Email = :usuario 
                                        AND LastName = :clave;");
        $sentencia->bindParam(':usuario',$usuario);
        $sentencia->bindParam(':clave',$password);
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll();
        // Extrae el NIF del cliente para usar en proximas aplicaciones
        setcookie("id_cliente", $resultado[0]["CustomerId"], time() + (86400 * 30), "/");
        setcookie("email", $resultado[0]["Email"], time() + (86400 * 30), "/");
    }
    
    
?>