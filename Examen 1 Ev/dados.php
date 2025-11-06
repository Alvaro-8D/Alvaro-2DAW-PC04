<?php
    include 'dadosfunc.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = limpiar_campos($_POST["nombre"]);
        $apellido1 = limpiar_campos($_POST["apellido1"]);
        $apellido2 = limpiar_campos($_POST["apellido2"]);
        $fecha_nac = limpiar_campos($_POST["fecha_nacimiento"]);
        $localidad = limpiar_campos($_POST["localidad"]);
        
        $alumno = str_pad($nombre,40," ",STR_PAD_RIGHT).str_pad($apellido1,40," ",STR_PAD_RIGHT).str_pad($apellido2,41," ",STR_PAD_RIGHT).str_pad($fecha_nac,9," ",STR_PAD_RIGHT).str_pad($localidad,26," ",STR_PAD_RIGHT);

        $archivo = fopen("alumnos1.txt", "a");
        fwrite($archivo,($alumno."\n"));
        $cadena = file_get_contents("alumnos1.txt");
        echo "<pre>",$cadena,"</pre>"; // uso <pre></pre> para que respete los saltos de linea
        fclose($archivo);
    }

?>
