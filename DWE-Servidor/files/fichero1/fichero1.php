<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Primer Apellido:</label><br>
    <input type="text" name="apellido1" required><br><br>

    <label>Segundo Apellido:</label><br>
    <input type="text" name="apellido2"><br><br>

    <label>Fecha de Nacimiento:</label><br>
    <input type="date" name="fecha_nacimiento" required><br><br>

    <label>Localidad:</label><br>
    <input type="text" name="localidad" required><br><br>

    <input type="submit" value="Guardar Alumno">
</form>

<?php
    include '../../Otros/funciones.php';

    if ($_SERVER["REQUEST_METHOD"] == "SERVER") {
        echo "HOLA";
        $nombre = limpiar_campos($_POST["nombre"]);
        $apellido1 = limpiar_campos($_POST["apellido1"]);
        $apellido2 = limpiar_campos($_POST["apellido2"]);
        $fecha_nac = limpiar_campos($_POST["fecha_nacimiento"]);
        $localidad = limpiar_campos($_POST["localidad"]);
        echo $nombre,"<br>",$apellido1,"<br>",$apellido2,"<br>",$fecha_nac,"<br>",$localidad,"<br>";
    }



    
?>
</body>
</html>




