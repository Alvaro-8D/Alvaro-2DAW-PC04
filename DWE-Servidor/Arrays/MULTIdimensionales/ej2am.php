<HTML>
<HEAD><TITLE>  EJ2AM Arrays</TITLE></HEAD>
<BODY>
<?php

    $f = 3; // filas del array
    $c = 3; // columnas del array
    $pares;
    $fila = "";

    $k = 2;
    for ($i=0; $i < $f; $i++) {  
        $suma=0;
        for ($j=0; $j < $c; $j++) {  
            $pares[$i][$j] = $k;
            $suma += $k;       
            $k+=2;
        }
        $pares[$i][($j+1)] = "<p><b>".$suma."</b></p>";
    }   

    for ($i=0; $i < $c; $i++) {  
        $suma2=0;
        for ($j=0; $j < $f; $j++) { 
            $suma2 += $pares[$j][$i];       
        }
        $pares[($j+1)][$i] = "<p><b>".$suma2."</b></p>";
    }

    
    foreach ($pares as $key1 => $seccion) {
        $columna = "";
        foreach ($seccion as $key2 => $value) {
            $columna = $columna."<td> ".$value." </td>";
        }
        $fila = $fila."<tr>".$columna."</tr>";
    }
    $cmd = "<table border=\"1px\">".$fila." </table>";

    print($cmd);
?>


</BODY>
</HTML>
