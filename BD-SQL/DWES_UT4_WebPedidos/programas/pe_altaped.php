<?php require '../funciones/fun_comunes.php'; impide_acceso_sesion_cerrada(); ?>
<h1>Formulario: Alta Pedidos</h1>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <?php detecta_sesion_iniciada(); ?>
</form>

<a href="pe_inicio.php"><button>Pagina de Inicio</button></a>

<?php
    include '../funciones/fun_pe_alyaped.php';
    cerrar_sesion();
    //detecta_sesion_iniciada();
    
?>