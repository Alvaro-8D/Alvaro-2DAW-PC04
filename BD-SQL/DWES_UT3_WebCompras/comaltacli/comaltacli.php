<h1>Formulario: Alta de Clientes</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_comaltacli.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>DNI: <input name="dni" type="text" required></p>
    <p>Nombre: <input name="nombre" type="text"></p>
    <p>Apellido: <input name="apellido" type="text"></p>
    <p>Codigo Postal: <input name="cp" type="text"></p>
    <p>Dirección: <input name="direc" type="text"></p>
    <p>Ciudad: <input name="ciudad" type="text"></p>
    <input type="submit" value="Enviar" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dni = limpiar_campos($_POST['dni']);
        if(dni_correcto($dni,conexionBD())) {
            $nombre = limpiar_campos($_POST['nombre']);
            $apellido = limpiar_campos($_POST['apellido']);
            $cp = limpiar_campos($_POST['cp']);
            $direc = limpiar_campos($_POST['direc']);
            $ciudad = limpiar_campos($_POST['ciudad']);

            if (!$nombre) $nombre = null;
            if (!$apellido) $apellido = null;
            if (!$cp) $cp = null;
            if (!$direc) $direc = null;
            if (!$ciudad) $ciudad = null;

            registrarCliente($dni,$nombre,$apellido,$cp,$direc,$ciudad); //realiza todo el programa de Introducir Almacenes
        }else{
            echo "<h3 style=\"color:red\">Formato de DNI Incorrecto o DNI Repetido *</h3>";
            mostrar_cliente(conexionBD());
        }
    }
    
?>

