<h1>Formulario: Alta de Productoss</h1>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Nombre del Producto : <input name="nombre" type="text" required></p>
    <p>Precio del Producto : <input name="nombre" type="text" required></p>
    <p>Categoría del Producto : <input name="nombre" type="text" required></p>
    <input type="submit" value="Enviar" />
</form>

<?php
    require '../fun_comunes.php';
    include 'fun_comaltapro.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $nombre = limpiar_campos($_POST['nombre']);

        nuevaCategoria($nombre); //realiza todo el programa de Introducir Categorías
    }
    
?>