<h1>Formulario: Alta de Empleados</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_empcambiodpto.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Nombre del Empleado : <input name="nombre" type="text" required></p>
    <p>Apellidos del Empleado : <input name="apellidos" type="text" required></p>
    <p>DNI : <input name="dni" type="text" required></p>
    <p>Fecha de Nacimiento : <input name="fecna" type="date" required></p>
    <p>Salario : <input name="salario" type="number" required></p>
    <p>Departamento : 
        <select name="departamento">
            <!-- Extrae los departamentos de la BD y las mestra en el HTMl -->
            <?php extraerDepartamentos(); ?>
        </select>
    </p>
    <input type="submit" value="Enviar" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $nombre = limpiar_campos($_POST['nombre']);
        $apellidos = limpiar_campos($_POST['apellidos']);
        $dni = limpiar_campos($_POST['dni']);
        $fecna = limpiar_campos($_POST['fecna']);
        $salario = (int) limpiar_campos($_POST['salario']);
        $depart = limpiar_campos($_POST['departamento']);

        nuevoEmpleado($nombre,$apellidos,$dni,$fecna,$salario,$depart); //realiza todo el programa de Introducir Empleados
    }
    
?>