<h1>Formulario: Alta de Almacenes</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_comaltaalm.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Localidad del Almacen : <input name="localidad" type="text" required></p>
    <input type="submit" value="Enviar" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $localidad = limpiar_campos($_POST['localidad']);

        nuevoAlmacen($localidad); //realiza todo el programa de Introducir Almacenes
    }
    
?>