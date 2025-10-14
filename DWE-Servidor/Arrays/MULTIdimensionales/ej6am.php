<HTML>
<HEAD><TITLE>  EJ6AM Arrays</TITLE></HEAD>
<BODY>
<?php

    $f = 3; // filas del array
    $c = 3; // columnas del array
    $fila = "";  
// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> SIN ACABAR
    for ($i=0; $i < $f; $i++) {  
        for ($j=0; $j < $c; $j++) {  
            $tabla[$i][$j] = random_int(1,100);
        }
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
    
    echo ">>-------- Por Columnas --------><br>";
    for ($i=0; $i < count($tabla[0]); $i++) {  
        $suma=0;
        for ($j=0; $j < count($tabla); $j++) {  
            echo "(",$j,",",$i,") = ",$tabla[$j][$i],"<br>";
        }
        echo "<br>";
    }
    
    
?>

</BODY>
</HTML>
