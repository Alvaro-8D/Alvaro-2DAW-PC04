<h1>Formulario: Consulta de Compras</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_comconscli.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <!-- MOSTRAR DEL LA COOKIE GUARDADA EL NOMBRE DEL CLIENTE -->
    <?php extraerClienteActual($_COOKIE["id_cliente"]); ?>
    
    <p>Fecha DESDE:  <input name="fecha_inicio" type="date" required></p>
    <p>Fecha HASTA:  <input name="fecha_fin" type="date" required></p>
    <input type="submit" value="Mostrar Compras" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $cliente = $_COOKIE["id_cliente"];
        $fecha_inicio = limpiar_campos($_POST['fecha_inicio']);
        $fecha_fin = limpiar_campos($_POST['fecha_fin']);

        compras_de_cliente($cliente,$fecha_inicio,$fecha_fin); //realiza todo el programa de Introducir Productos
    }
    
?>