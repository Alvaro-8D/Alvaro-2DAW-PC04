<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
    include '../funciones_ficheros.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = limpiar_campos($_POST["nombre"]);
        $apellido1 = limpiar_campos($_POST["apellido1"]);
        $apellido2 = limpiar_campos($_POST["apellido2"]);
        $fecha_nac = limpiar_campos($_POST["fecha_nacimiento"]);
        $localidad = limpiar_campos($_POST["localidad"]);
        
        $alumno = $nombre."##".$apellido1."##".$apellido2."##".$fecha_nac."##".$localidad;

        $archivo = fopen("alumnos2.txt", "a");
        fwrite($archivo,($alumno."\n"));
        $cadena = file_get_contents("alumnos2.txt");
        echo "<pre>",$cadena,"</pre>"; // uso <pre></pre> para que respete los saltos de linea
        fclose($archivo);
    }



    
?>
</body>
</html>




