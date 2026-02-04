<?php require '..\funci\fun_comunes.php'; impide_acceso_sesion_cerrada(); ob_start();?>
<h1>Pago CORRECTO ✅</h1>

<?php 
    
    try {
        $consulta = conexionBD();
        $consulta->beginTransaction();
        // ********************* Actualizar el campo "estado_pago" **************************
        $sentencia = $consulta->prepare(" UPDATE reservas set estado_pago = 'pagado' where id_reserva = :id_reserva_actual;");
        $sentencia->bindParam(':id_reserva_actual',$_COOKIE["id_reserva_actual"]);
        $sentencia->execute();
        $array_carrito = unserialize($_COOKIE['carrito']);
        // ********************* Restar asientos disponibles de los vuelos **************************
        foreach ($array_carrito as $id_vuelo => $cantidad) {
            restar_productos($consulta,$cantidad,$id_vuelo); // restar vuelos pagados
        }
        $consulta->commit();
        // Una vez cambiado el campo "estado_pago" correctamente, eliminamos la cookie
        setcookie("id_reserva_actual", "", time() - 36000,"/");
        // Borra el carrito en caso de que la operación salga correcta
        setcookie("carrito", serialize(array()), time() + (86400 * 30), "/");
        
    }catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        $consulta->rollBack();

    }finally{ 
        $consulta = null;
    }

    function restar_productos($consulta,$cantidad,$id_vuelo){ 
        //resta los vuelos pagados correctamente de la base de datos
        $sentencia = $consulta->prepare("UPDATE VUELOS
                                        SET asientos_disponibles = asientos_disponibles	- :cantidad
                                        WHERE id_vuelo = :id_vuelo;");
        $sentencia->bindParam(':cantidad',$cantidad);
        $sentencia->bindParam(':id_vuelo',$id_vuelo);
        $sentencia->execute();
    }
?>

<br>
<a href="../vreservas.php"><button>Volver</button></a>