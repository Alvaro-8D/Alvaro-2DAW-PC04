<?php
    function iniciar_sesion($nombre,$password){
        // Funcion principal del programa
        $consulta = conexionBD();

        try {
            if(comprobar_crecenciales($consulta,$nombre,$password)){ //comprueba que usuario y contraseña son correctos
                generar_cookies($consulta,$nombre,$password); // genera las cookies
                entrar(); // entra al portal del cliente donde puede elegir si ver cesta o comprar producto
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function comprobar_crecenciales($consulta,$nombre,$password){
        $ok = false;
        $sentencia = $consulta->prepare("SELECT NOMBRE,CLAVE
                                        FROM cliente
                                        WHERE NOMBRE = :usuario 
                                        AND CLAVE = :clave;");
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
        $sentencia = $consulta->prepare("SELECT NIF
                                        FROM cliente
                                        WHERE NOMBRE = :usuario
                                        AND CLAVE = :clave;");
        $sentencia->bindParam(':usuario',$nombre);
        $sentencia->bindParam(':clave',$password);
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll();
        // Extrae el NIF del cliente para usar en proximas aplicaciones
        setcookie("id_cliente", $resultado[0]["NIF"], time() + (86400 * 30), "/");
    }
    
    function entrar(){
        echo "<a href=\"../comprocli/comprocli.php\" target=\"_blank\"><button>Compra de Productos</button></a><br><br>";
        echo "<a href=\"../comconscli/comconscli.php\" target=\"_blank\"><button>Consulta de Compras</button></a>";
    }
?>