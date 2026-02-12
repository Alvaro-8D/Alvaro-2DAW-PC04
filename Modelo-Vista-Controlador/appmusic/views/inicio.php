<h1>Página de Inicio</h1>

<!-- Menu de Inicio -->
<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <?php require_once 'fun_comunes.php'; detecta_sesion_iniciada(); ?> 
    <br><br> **************** Funcionalidades ******************<br>
    <input name="historial_pagos" type="submit" value="Historial de Facturas" style="background-color: #007bff; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; margin: 5px;">
    <input name="downmusic" type="submit" value="Descargar/Comprar Música" style="background-color: #28a745; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; margin: 5px;">
    <input name="facturas" type="submit" value="Facturas (filtrado por fecha)" style="background-color: #fd7e14; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; margin: 5px;">
    <input name="ranking" type="submit" value="Ranking de Canciones Descargadas" style="background-color: #6f42c1; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; margin: 5px;">
</form>
