<?php
    impide_acceso_sesion_abierta();
    require_once 'views\login.php';
    require_once 'controllers\fun_comunes.php';
    require_once 'models\bd_login.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        cerrar_sesion();
        $usuario = limpiar_campos($_POST['usuario']);
        $password = limpiar_campos($_POST['password']);

        iniciar_sesion($usuario,$password); //realiza todo el programa de Introducir Categorías
    }


    function iniciar_sesion($usuario,$password){
        // Funcion principal del programa
        try {
            if(comprobar_crecenciales($usuario,$password)){ //comprueba que usuario y contraseña son correctos
                list($id_cliente_cookie,$email_cookie) = datos_generar_cookies($usuario,$password); // genera las cookies
                setcookie("id_cliente", $id_cliente_cookie, time() + (86400 * 30), "/");
                setcookie("email", $email_cookie, time() + (86400 * 30), "/");
                header("Location: controllers/fun_inicio.php"); // Redirije a la la pagina de "Comprar Producto"
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        //$GLOBALS['conexion'] = null;
    }

    function impide_acceso_sesion_abierta(){ // al inicio del PHP ==> PRIMERA LINEA
        // Reenvia a la página de Log In si no hay sesión iniciada
        if(isset($_COOKIE['email'])&&isset($_COOKIE['id_cliente'])){header("Location: controllers/fun_inicio.php"); return false;}else{return true;}
    }
    
?>