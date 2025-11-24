<h1>Formulario: Alta de Productoss</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_comaltapro.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Nombre del Producto : <input name="nombre" type="text" required></p>
    <p>Precio del Producto : <input name="precio" type="text" required></p>
    <p>Categoría del Producto : 
        <select name="categoria">
            <!-- Extrae las categorias de la BD y las mestra en el HTMl -->
            <?php extraerCategorias(); ?>
        </select>
    </p>
    <input type="submit" value="Enviar" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $nombre = limpiar_campos($_POST['nombre']);
        $precio = limpiar_campos($_POST['precio']);
        $categoria = limpiar_campos($_POST['categoria']);

        nuevoProducto($nombre,$precio,$categoria); //realiza todo el programa de Introducir Productos
    }
    
?>