<h1>Formulario: Listado Empleados Actualmente en el Departamento</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_emplistadpto.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Visualizar Empleados del Departamento: 
        <select name="departamento">
            <!-- Extrae los departamentos de la BD y las mestra en el HTMl -->
            <?php extraerDepartamentos(); ?>
        </select>
    </p>
    <input type="submit" value="Ver Listado" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $depart = limpiar_campos($_POST['departamento']);

        verListadoActual($depart); //realiza todo el programa de Introducir Empleados
    }
    
?>