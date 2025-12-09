<h1>Formulario: Compra de Productos</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_compro.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Cliente : 
        <select name="cliente">
            <!-- Extrae los clientes de la BD y las mestra en el HTMl -->
            <?php extraerClientes(); ?>
        </select>
    </p>
    <p>Producto que quiere Comprar : 
        <select name="producto">
            <!-- Extrae los almacenes de la BD y las mestra en el HTMl -->
            <?php extraerProductos(); ?>
        </select>
    </p>
    <p>Fecha de la Compra:  <input name="fecha" type="date" required></p>
    <p>Cantidad:  <input name="cantidad" type="number" required></p>
    <input type="submit" value="Comprar" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cliente = limpiar_campos($_POST['cliente']);
        $producto = limpiar_campos($_POST['producto']);
        $cantidad = intval(limpiar_campos($_POST['cantidad']));
        $fechaCom = limpiar_campos($_POST['fecha']);
        if ($cantidad >= 1){
            comprarProducto($cliente,$producto,$cantidad,$fechaCom);
        }else{
            echo "<h3 style=\"color:red\">Debes comprar AL MENOS 1 Producto *</h3>";
        }
    }
    
?>

