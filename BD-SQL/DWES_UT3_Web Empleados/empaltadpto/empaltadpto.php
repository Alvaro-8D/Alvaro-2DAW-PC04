<h1>Formulario: Alta de Departamentos</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_empaltadpto.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Nombre del Departamento : <input name="nombre" type="text" required></p>
    <input type="submit" value="Enviar" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $nombre = limpiar_campos($_POST['nombre']);

        nuevoDepartamento($nombre); //realiza todo el programa de Introducir Departamentos
    }
    
?>