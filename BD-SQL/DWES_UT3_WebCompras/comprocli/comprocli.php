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
    <p>Cantidad:  <input name="cantidad" type="number" ></p>
    <input type="submit" name="carrito" value="Añadir al Carrito" />
    <h4>..............................................................</h4>
    <p>Fecha de la Compra:  <input name="fecha" type="date"></p>
    <input type="submit" name="comprar" value="Comprar" />
    
    
</form>

<?php
    if(!$_SESSION["carrito"]){$_SESSION["carrito"] = array();} //si no existe la variable de sesión, la crea como un array vacio
    $carrito = $_SESSION["carrito"]; //carga el carrito en una variable
    
    //comprueba que hayas pulsado el boton "Añadir al Carrito"
    if(array_key_exists("carrito",$_POST)){$boton_carrito = $_POST["carrito"];}else{$boton_carrito = null;}
    //comprueba que hayas pulsado el boton "Comprar"
    if(array_key_exists("comprar",$_POST)){$boton_comprar = $_POST["comprar"];}else{$boton_comprar = null;}
    
    boton_carrito($boton_carrito,$carrito); // añade productos al carrito
    boton_comprar($boton_comprar,$carrito); // compra los productos del carrito (solo si hay stock)

    verCarrito(); // Muestra por pantalla el carrito
?>

