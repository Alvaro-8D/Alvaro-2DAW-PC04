<?php
    ob_start(); // Soluciona problemas con los "headers"
    // Conexión base de datos
    require_once '..\db\conexion_bd.php'; 
    // Funciones Comunes
    require_once 'fun_comunes.php';
    impide_acceso_sesion_cerrada();
    // Funciones Especicas del Fichero
    require_once '..\views\downmusic.php';


    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        if(isset($_POST['carrito'])){
            boton_carrito();
        }
        if(isset($_POST['vaciar'])){
            setcookie("carrito", serialize(array()), time() + (86400 * 30), "/");
            header("Location: fun_downmusic.php");
        }
            
    }

    verCarrito();

// ************************** FUNCIONES ****************************************
    function extraerMusica(){
        // Extrae las Musica de la BD y las muestra en el HTMl
        $sentencia = $GLOBALS['conexion']->prepare("SELECT TrackId, Name, UnitPrice from track;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["TrackId"],"\">",$value["Name"]," >>> ",$value["UnitPrice"]," $</option>";
        }
    }

    function boton_carrito(){
        // modifica la variable se sesion con nuevos productos del carrito
        if (isset($_COOKIE['carrito'])) {
            $carrito = unserialize($_COOKIE['carrito']);
        }else{
            $carrito = array();
        }

        $id_cancion = limpiar_campos($_POST['track']);
        $cantidad = intval(limpiar_campos($_POST['cantidad']));
        if ($cantidad >= 1){
            if(array_key_exists($id_cancion,$carrito)){
                $carrito[$id_cancion] = $carrito[$id_cancion] + $cantidad;
            }else{
                $carrito[$id_cancion] = $cantidad;
            }
            setcookie("carrito", serialize($carrito), time() + (86400 * 30), "/");
            header("Location: fun_downmusic.php");
        }else{
            echo "<h3 style=\"color:red\">Debes añadir AL MENOS 1 Producto *</h3>";
        }
    }

    function verCarrito(){
        // Muestra por pantalla el Carrito de la Compra
        if(isset($_COOKIE["carrito"])&&unserialize($_COOKIE["carrito"])!=array()){
            echo "<h2>Carrito de la Compra: </h2>";
            var_dump(unserialize($_COOKIE["carrito"]));
        }
    }
    
?>