<h1>Formulario: Registrar Cliente</h1>
<!-- Importar funciones PHP -->
<?php require '../fun_comunes.php'; include 'fun_comregcli.php';?>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>DNI: <input name="dni" type="text" required></p>
    <p>Nombre: <input name="nombre" type="text" required></p>
    <p>Apellido: <input name="apellido" type="text" required></p>
    <p>Codigo Postal: <input name="cp" type="text" required></p>
    <p>Dirección: <input name="direc" type="text" required></p>
    <p>Ciudad: <input name="ciudad" type="text" required></p>
    <input type="submit" value="Registrarse" />
</form>
<!-- 
SQL:
    use comprasweb;

    ALTER TABLE cliente
    ADD (CLAVE VARCHAR(40));
-->
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dni = limpiar_campos($_POST['dni']);
        if(dni_correcto($dni,conexionBD())) {
            $nombre = limpiar_campos($_POST['nombre']);
            $apellido = limpiar_campos($_POST['apellido']);
            $cp = limpiar_campos($_POST['cp']);
            $direc = limpiar_campos($_POST['direc']);
            $ciudad = limpiar_campos($_POST['ciudad']);

            $clave = strtolower(strrev($apellido));

            registrarCliente($dni,$nombre,$apellido,$cp,$direc,$ciudad,$clave); //realiza todo el programa de Introducir Almacenes
        }else{
            echo "<h3 style=\"color:red\">Formato de DNI Incorrecto o DNI Repetido *</h3>";
            mostrar_cliente(conexionBD());
        }
    }
    
?>

