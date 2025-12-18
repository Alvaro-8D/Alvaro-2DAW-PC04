<h1>Formulario: Consulta de Compras</h1>
<h2>Comprar Productos >>>>>> <a href="../comprocli/comprocli.php" ><button>Compra de Productos</button></a></h2>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_comconscli.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <!-- MOSTRAR DEL LA COOKIE GUARDADA EL NOMBRE DEL CLIENTE -->
    <?php extraerClienteActual($_COOKIE["id_cliente"]); ?> <input type="submit" name="cerrar_sesion" value="Cerrar Sesión"/>
    <p>Fecha DESDE:  <input name="fecha_inicio" type="date" ></p>
    <p>Fecha HASTA:  <input name="fecha_fin" type="date" ></p>
    <input type="submit" value="Mostrar Compras" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        cerrar_sesion();   
        $cliente = $_COOKIE["id_cliente"];
        $fecha_inicio = limpiar_campos($_POST['fecha_inicio']);
        $fecha_fin = limpiar_campos($_POST['fecha_fin']);

        if(!$fecha_inicio){$fecha_inicio = date("Y-m-d"); echo "<h3 style=\"color:BLUE\">Fecha por defecto => DESDE de HOY *</h3>";}
        if(!$fecha_fin){$fecha_fin = date("Y-m-d"); echo "<h3 style=\"color:BLUE\">Fecha por defecto => HASTA de HOY *</h3>";}

        compras_de_cliente($cliente,$fecha_inicio,$fecha_fin); //realiza todo el programa de Introducir Productos
    }
    
?>