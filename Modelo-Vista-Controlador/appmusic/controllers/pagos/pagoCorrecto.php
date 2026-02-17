<?php 
    // Conexión base de datos
    require_once '../../db/conexion_bd.php';  
    // Funciones Comunes
    require_once '../fun_comunes.php';
    // Funciones Modelo-BD  
    require_once '../../models/bd_downmusic.php';  
    impide_acceso_sesion_cerrada(); ob_start();
?>

<h1>Pago CORRECTO ✅</h1>

<?php actualizar_bd(); ?>

<br>
<a href="../fun_downmusic.php"><button>Volver</button></a>