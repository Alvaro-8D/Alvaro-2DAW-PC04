<?php require '../funciones/fun_comunes.php'; impide_acceso_sesion_cerrada(); ?>
<h1>Formulario: Inicio Cliente</h1>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <?php detecta_sesion_iniciada(); ?>
</form>

<?php
    cerrar_sesion();
    //detecta_sesion_iniciada();
    
?>

<br><br>***********************************************
<br><a href="pe_altaped.php"><button>Alta Pedidos</button></a>