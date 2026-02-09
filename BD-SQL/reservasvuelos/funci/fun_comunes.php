<?php
    function limpiar_campos($data) { //Evita la Injección de Código
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function conexionBD() { // Conectarse a la BD
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "reservas";

        $consulta = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $consulta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $consulta;
    }

    function cerrar_sesion(){ // DENTRO de >> if ($_SERVER["REQUEST_METHOD"] == "POST") >> AL INICIO
        // Cierra la Sesión (elimina cookies y variables de sesión)
        //Crea una entrada en _POST para saber si se pulsa el boton "Cerrar Sesión"
        if(!array_key_exists("cerrar_sesion",$_POST)){$_POST["cerrar_sesion"] = null;}
        

        //comprueba que hayas pulsado el boton "Cerrar Sesión"
        if(array_key_exists("cerrar_sesion",$_POST)){
            if($_POST["cerrar_sesion"] !== null){
                $boton_cerrar_sesion = $_POST["cerrar_sesion"];
            }else{$boton_cerrar_sesion = null;}}else{$boton_cerrar_sesion = null;}

        // Cuando BOTON ha sido PULSADO, elimina los datos (cookies y sesiones)
        if($boton_cerrar_sesion){
            if(array_key_exists("PHPSESSID",$_COOKIE)){
                session_unset();// elimina variables de sesión
                session_destroy();// elimina la sesión
            //Elimina la Cookie local que contiene el id de la sesión (si existe)
                setcookie("PHPSESSID", "", time() - 3600,"/");
            }
            setcookie("id_cliente", "", time() - 36000,"/");
            setcookie("carrito", "", time() - 36000,"/");
            // Evita que el programa vuelva a iniciar sesion y lo DETIENE
            header("Location: index.php");
            exit("<h3 style=\"color:Blue\">Has CERRADO Sesion CORRECTAMENTE</h3>");
        }
    }

    function detecta_sesion_iniciada(){ // Poner al final del >> if ($_SERVER["REQUEST_METHOD"] == "POST")
        
        if(isset($_COOKIE) && $_COOKIE !== array()){
            echo "<h2> [Sesion Iniciada con: ",$_COOKIE["nombre"]," ",$_COOKIE["apellido"],"] </h2>";
            echo "<input type=\"submit\" name=\"cerrar_sesion\" value=\"Cerrar Sesion\"/> ";
        }

        // Boton para cerrar sesion:
        //  HTML >    <input type="submit" name="cerrar_sesion" value="Cerrar Sesión"/>
        //  PHP >    echo "<input type=\"submit\" name=\"cerrar_sesion\" value=\"Cerrar Sesión\" /> </h2>";
    }

    function impide_acceso_sesion_cerrada(){ // al inicio del PHP ==> PRIMERA LINEA
        // Reenvia a la página de Log In si no hay sesión iniciada

        // (de momento, solo necesito 'id_cliente', 'PHPSESSID' es más dificil de controlar)
        $mis_cookies = array('id_cliente'); // mis cookies

        $existen_mis_cookies = false; // Se usa para solo dejar pasar si tiene MIS cookies
        
        foreach ($mis_cookies as $key => $value) {
            if (array_key_exists($value,$_COOKIE)) {
                $existen_mis_cookies = true;
            }
        }

        // si NO existen MIS cookies, entonces te bloquea el paso a esta página y te reenvia a la paginad de login
        if(!isset($_COOKIE)||!$existen_mis_cookies){header("Location: index.php"); return false;}else{return true;}

        /* Copiar y pegar esto al inicio: 
                    <?php impide_acceso_sesion_cerrada(); ?>
        */
    }

    function extraerEmail(){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("SELECT email
                                        FROM clientes
                                        WHERE dni = :usuario;");
        $sentencia->bindParam(':usuario',$_COOKIE['id_cliente']);
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo    
        $_SESSION['email'] = $resultado[0]["email"];
        $consulta = null;
    }
    function extraerNombre(){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("SELECT nombre
                                        FROM clientes
                                        WHERE dni = :usuario;");
        $sentencia->bindParam(':usuario',$_COOKIE['id_cliente']);
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo    
        $_SESSION['nombre'] = $resultado[0]["nombre"];
        $consulta = null;
    }
    function extraerFecha(){  
        echo date("y-m-d H:i:s");
        $consulta = null;
    }
?>