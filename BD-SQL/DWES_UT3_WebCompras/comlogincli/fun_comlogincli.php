<?php
    function iniciar_sesion($nombre,$password){
        // Funcion principal del programa
        $consulta = conexionBD();

        try {
            if(comprobar_crecenciales($nombre,$password)){ //comprueba que usuario y contraseña son correctos
                generar_cookies($nombre); // genera las cookies
                entrar(); // entra al portal del cliente donde puede elegir si ver cesta o comprar producto
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function comprobar_crecenciales($nombre,$password){
        $ok = false;

        if($ok){
            echo "<h3 style=\"color:#00cc23\">Has Iniciado Sesion CORRECTAMENTE</h3>";
        }else{
            echo "<h3 style=\"color:red\">La CONTRASEÑA o el USUARIO son INCORRECTOS</h3>";
        }
        return $ok;
    }

    function generar_cookies($nombre){
        //cokies
    }
    
    function entrar(){
        echo "Redirigiendo a .... (proximamente)";
    }
?>