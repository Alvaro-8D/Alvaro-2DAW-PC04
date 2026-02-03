<h1>Pago CORRECTO ✅</h1>

<?php 
    // Borra el carrito en caso de que la operación salga correcta
    setcookie("carrito", serialize(array()), time() + (86400 * 30), "/");
/*
// FALTA HACER ESTA PARTE
    $consulta = conexionBD();
    $consulta->beginTransaction();
    $sentencia = $consulta->prepare("UPDATE reservas
                                        SET estado_pago = asientos_disponibles	- :cantidad
                                        WHERE id_vuelo = :id_vuelo;");
    $consulta->commit();
    */
    var_dump($_SESSION);
?>

<br>
<a href="../vreservas.php"><button>Volver</button></a>