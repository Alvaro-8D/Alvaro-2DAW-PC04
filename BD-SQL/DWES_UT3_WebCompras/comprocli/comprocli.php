<h1>Formulario: Compra de Productos</h1>
<!-- Importar funciones PHP -->
<?php session_start(); require '../fun_comunes.php'; include 'fun_comprocli.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <!-- MOSTRAR DEL LA COOKIE GUARDADA EL NOMBRE DEL CLIENTE -->
    <?php extraerClienteActual($_COOKIE["id_cliente"]); ?>
    <p>Producto que quiere Comprar : 
        <select name="producto">
            <!-- Extrae los almacenes de la BD y las mestra en el HTMl -->
            <?php extraerProductos(); ?>
        </select>
    </p>
    <p>Fecha de la Compra:  <input name="fecha" type="date" required></p>
    <p>Cantidad:  <input name="cantidad" type="number" required></p>
    <input type="submit" value="Añadir al Carrito" />
</form>

<?php
    $carrito = $_SESSION["carrito"]; //carga el carrito en una variable

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cliente = $_COOKIE["id_cliente"];
        $producto = limpiar_campos($_POST['producto']);
        $cantidad = intval(limpiar_campos($_POST['cantidad']));
        $fechaCom = limpiar_campos($_POST['fecha']);

        if ($cantidad >= 1){
            
            $mete_al_carrito = array("cliente"=>$cliente,"producto"=>$producto,"cantidad"=>$cantidad,"fecha"=>$fechaCom);
            array_push($carrito,$mete_al_carrito);
            $_SESSION["carrito"] = $carrito;
            //$_SESSION["carrito"] = array();
            //comprarProducto($cliente,$producto,$cantidad,$fechaCom);
        }else{
            echo "<h3 style=\"color:red\">Debes comprar AL MENOS 1 Producto *</h3>";
        }
    }
    
    verCarrito()
?>

