<?php
    require_once '..\views\downmusic.php';
    var_dump($_POST);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        require_once '..\views\downmusic.php';
        if(isset($_POST['carrito'])){
            echo 'HOLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';var_dump($_POST);
        }
        
    }

    function extraerMusica(){
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $GLOBALS['conexion']->prepare("SELECT TrackId, Name, UnitPrice from track;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["TrackId"],"\">",$value["Name"]," (",$value["UnitPrice"]," $)</option>";
        }
    }

    function boton_carrito(){
        // modifica la variable se sesion con nuevos productos del carrito
        if ($boton_carrito) {
            $id_vuelo = limpiar_campos($_POST['vuelos']);
            $cantidad = intval(limpiar_campos($_POST['cantidad']));
            if ($cantidad >= 1){
                if(array_key_exists($id_vuelo,$carrito)){
                    $carrito[$id_vuelo] = $carrito[$id_vuelo] + $cantidad;
                }else{
                    $carrito[$id_vuelo] = $cantidad;
                }
                setcookie("carrito", serialize($carrito), time() + (86400 * 30), "/");
                header("Location: vreservas.php");
            }else{
                echo "<h3 style=\"color:red\">Debes añadir AL MENOS 1 Producto *</h3>";
            }
        }
    }
    
?>