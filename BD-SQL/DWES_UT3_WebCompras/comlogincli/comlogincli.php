<h1>Formulario: Log In Cliente</h1>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Usuario : <input name="usuario" type="text" required></p>
    <p>Contraseña : <input name="password" type="password" required></p>
    <input type="submit" value="Log In" />
</form>

<?php
    require '../fun_comunes.php';
    include 'fun_comlogincli.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $nombre = limpiar_campos($_POST['usuario']);
        $password = limpiar_campos($_POST['password']);

        var_dump($nombre,$password);

        iniciar_sesion($nombre,$password); //realiza todo el programa de Introducir Categorías
    }
    
?>