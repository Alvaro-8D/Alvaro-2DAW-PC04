<h1>Formulario: Alta de Almacenes</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_comaprpro.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Lugar de Almacenamiento: 
        <select name="almacenamiento">
            <!-- Extrae los almacenes de la BD y las mestra en el HTMl -->
            <?php extraerAlmacenes(); ?>
        </select>
    </p>
    <p>Producto que se va a Almacenar: 
        <select name="producto">
            <!-- Extrae los productos de la BD y las mestra en el HTMl -->
            <?php extraerProductos(); ?>
        </select>
    </p>
    <p>Cantidad de Porductos a Almacenar : <input name="cantidad" type="number" required></p>
    <input type="submit" value="Enviar" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $almacenamiento = limpiar_campos($_POST['almacenamiento']);
        $producto = limpiar_campos($_POST['producto']);
        $cantidad = limpiar_campos($_POST['cantidad']);

        almacenarProducto($almacenamiento,$producto,$cantidad); //realiza todo el programa de Almacenar Productos
    }
    
?>