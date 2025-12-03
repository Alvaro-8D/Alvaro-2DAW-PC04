<h1>Formulario: Consulta de Stock</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_comconstock.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Producto:  
        <select name="producto">
            <!-- Extrae los productos de la BD y las mestra en el HTMl -->
            <?php extraerProductos(); ?>
        </select>
    </p>
    <p>Almacen : 
        <select name="almacen">
            <!-- Extrae los almacenes de la BD y las mestra en el HTMl -->
            <?php extraerAlmacenes(); ?>
        </select>
    </p>
    <input type="submit" value="Mostrar STOCK" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $producto = limpiar_campos($_POST['producto']);
        $almacen = limpiar_campos($_POST['almacen']);

        consultar_stock($producto,$almacen); //realiza todo el programa de Introducir Productos
    }
    
?>