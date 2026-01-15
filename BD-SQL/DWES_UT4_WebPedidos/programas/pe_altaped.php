<?php require '../funciones/fun_comunes.php'; if(impide_acceso_sesion_cerrada()){session_start();}   
include '../funciones/fun_pe_altaped.php'; 
// Evita problemas con los Headers
ob_start();?>
<h1>Formulario: Alta Pedidos</h1>
<a href="pe_inicio.php"><button>Pagina de Inicio</button></a>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <!-- MOSTRAR DEL LA COOKIE GUARDADA EL NOMBRE DEL CLIENTE -->
    <?php extraerClienteActual(); ?>
    <input type="submit" name="cerrar_sesion" value="Cerrar Sesión"/>
    <p>Producto que quiere Comprar : 
        <select name="producto">
            <!-- Extrae los almacenes de la BD y las mestra en el HTMl -->
            <?php extraerProductos(); ?>
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp; <!-- Espacios HTML "&nbsp;" = " " -->
        Cantidad:  <input name="cantidad" type="number" >
    </p>
    <p>Número de Pago: <input name="num_pago" type="text" ></p>
    <input type="submit" name="carrito" value="Añadir al Carrito" />
    <h4>..............................................................</h4>
    <input type="submit" name="comprar" value="Comprar" />
</form>

<?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        //carga el carrito en una variable
        if(isset($_SESSION["carrito"])){$carrito = $_SESSION["carrito"];}else{$carrito = array();}

        cerrar_sesion();
        //comprueba que hayas pulsado el boton "Añadir al Carrito"
        if(array_key_exists("carrito",$_POST)){$boton_carrito = $_POST["carrito"];}else{$boton_carrito = null;}
        //comprueba que hayas pulsado el boton "Comprar"
        if(array_key_exists("comprar",$_POST)){$boton_comprar = $_POST["comprar"];}else{$boton_comprar = null;}
        
        
        boton_carrito($boton_carrito,$carrito); // añade productos al carrito
        boton_comprar($boton_comprar,$carrito); // compra los productos del carrito (solo si hay stock)
    }

    verCarrito(); // Muestra por pantalla el carrito
?>

