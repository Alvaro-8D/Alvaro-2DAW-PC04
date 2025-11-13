<h1>Formulario: Alta de Categorías</h1>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Nombre de Nueva Categoría : <input name="nombre" type="text" required></p>
    <input type="submit" value="Enviar" />
</form>

<?php
    require '../fun_comunes.php';
    include 'fun_comaltacat.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $nombre = limpiar_campos($_POST['nombre']);
        
        nuevaCategoria($nombre);
    }
?>