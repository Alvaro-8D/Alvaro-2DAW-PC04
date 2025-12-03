<h1>Formulario: Consulta de Almacenes</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_comconsalm.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Almacenes : 
        <select name="almacen">
            <!-- Extrae los almacenes de la BD y las mestra en el HTMl -->
            <?php extraerAlmacenes(); ?>
        </select>
    </p>
    <input type="submit" value="Mostrar STOCK del Almacén" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $almacen = limpiar_campos($_POST['almacen']);

        consultar_almacen($almacen); //realiza todo el programa de Introducir Productos
    }
    
?>