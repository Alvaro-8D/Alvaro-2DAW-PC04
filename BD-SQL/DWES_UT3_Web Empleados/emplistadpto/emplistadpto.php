<h1>Formulario: Listado Empleados Actualmente en el Departamento</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_empcambiodpto.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Empleado(DNI) : 
        <select name="dni">
            <!-- Extrae los departamentos de la BD y las mestra en el HTMl -->
            <?php extraerEmpleados(); ?>
        </select>
    </p>
    <p>Departamento al que se le quiere añadir : 
        <select name="departamento">
            <!-- Extrae los departamentos de la BD y las mestra en el HTMl -->
            <?php extraerDepartamentos(); ?>
        </select>
    </p>
    <input type="submit" value="Añadir al Departamento" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $dni = limpiar_campos($_POST['dni']);
        $depart = limpiar_campos($_POST['departamento']);

        nuevoDepartamento($dni,$depart); //realiza todo el programa de Introducir Empleados
    }
    
?>