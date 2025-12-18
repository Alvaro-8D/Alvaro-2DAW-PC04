<h1>Formulario: Log In Cliente</h1>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Usuario : <input name="usuario" type="text"></p>
    <p>Contraseña : <input name="password" type="password"></p>
    <input type="submit" value="Log In" />  <?php require '../fun_comunes.php'; detecta_sesion_iniciada(); ?>
</form>

<?php
    include 'fun_comlogincli.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        cerrar_sesion();
        $nombre = limpiar_campos($_POST['usuario']);
        $password = limpiar_campos($_POST['password']);

        iniciar_sesion($nombre,$password); //realiza todo el programa de Introducir Categorías
    }
    //detecta_sesion_iniciada();
    
?>
