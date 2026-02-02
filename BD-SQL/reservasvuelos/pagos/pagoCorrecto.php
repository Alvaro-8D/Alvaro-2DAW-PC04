<h1>Pago CORRECTO ✅</h1>

<a href="../vreservas.php"><button>Volver</button></a>

<?php 
    require '..\funci\fun_comunes.php';

    conexionBD()->commit(); //guarda los cambios si todo sale bien
    setcookie("carrito", serialize(array()), time() + (86400 * 30), "/");
        
?>