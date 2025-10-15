<HTML>
<HEAD><TITLE>  EJ6AM Arrays</TITLE></HEAD>
<BODY>
<?php

    $f = 3; // filas del array
    $c = 3; // columnas del array
    $fila = "";  

    for ($i=0; $i < $f; $i++) {  
        $n[$i] = 0; // Array con Máximos de cada Fila
        $n2[$i] = 0; // Array con Promedios de cada Fila
    }

    for ($i=0; $i < $f; $i++) {  
        for ($j=0; $j < $c; $j++) {  
            $tabla[$i][$j] = random_int(1,100);
            if ($n[$i] < ($tabla[$i][$j])) {
                  $n[$i] = $tabla[$i][$j];
            }
            $n2[$i]+=$tabla[$i][$j];
        }
    }  

    for ($i=0; $i < count($n); $i++) {  
        $n2[$i]=($n2[$i]/$f); // Calcula el Promedio de cada Fila
    }

    foreach ($tabla as $key1 => $seccion) {
        $columna = "";
        foreach ($seccion as $key2 => $value) {
            $columna = $columna."<td style=\"padding: 5px;border-width: 2px;\"> ".$value." </td>";
        }
        $fila = $fila."<tr>".$columna."</tr>";
    }
    $cmd = "<table border=\"1px\" style=\"border-collapse: collapse;\">".$fila." </table>";

    print($cmd);
    
    echo ">>-------- Máximos y Promedios -------->";
    foreach ($n as $key1 => $seccion) {
        echo "<br>Fila(",$key1,") >>> Máximo de Valores la Fila = ",$seccion;
    }
    echo "<br>";
    foreach ($n2 as $key1 => $seccion) {
        echo "<br>Fila(",$key1,") >>> Promedio de Valores la Fila = ",$seccion;
    }
    
    
?>

</BODY>
</HTML>
