<h1>Página de Inicio</h1>

<!-- Menu de Inicio -->
<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <?php require_once 'fun_comunes.php'; detecta_sesion_iniciada(); ?> 
    <br><br> **************** Funcionalidades ******************<br><br>
    <input name="historial_pagos" type="submit" value="Historial de Facturas">
</form>
