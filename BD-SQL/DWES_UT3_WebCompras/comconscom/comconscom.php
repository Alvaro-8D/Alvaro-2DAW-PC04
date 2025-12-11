<h1>Formulario: Consulta de Compras</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_comconscom.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Cliente : 
        <select name="cliente">
            <!-- Extrae los almacenes de la BD y las mestra en el HTMl -->
            <?php extraerClientes(); ?>
        </select>
    </p>
    <p>Fecha DESDE:  <input name="fecha_inicio" type="date" required></p>
    <p>Fecha HASTA:  <input name="fecha_fin" type="date" required></p>
    <input type="submit" value="Mostrar Compras" />
</form>

<?php
// HACER PRIMERO "ALTA CLIENTES" Y "COMPRA DE PRODUCTOS"
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $cliente = limpiar_campos($_POST['cliente']);
        $fecha_inicio = limpiar_campos($_POST['fecha_inicio']);
        $fecha_fin = limpiar_campos($_POST['fecha_fin']);

        compras_de_cliente($cliente,$fecha_inicio,$fecha_fin); //realiza todo el programa de Introducir Productos
    }
    
?>