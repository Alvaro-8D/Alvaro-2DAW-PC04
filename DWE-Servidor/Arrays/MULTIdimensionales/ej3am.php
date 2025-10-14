<HTML>
<HEAD><TITLE>  EJ3AM Arrays</TITLE></HEAD>
<BODY>
<?php

    $tabla = array(array(2, 4, 6, 9, 7),array(8, 10, 12, 1, 12),array(14, 16, 88, 3, 15));
    $fila = "";  

    foreach ($tabla as $key1 => $seccion) {
        $columna = "";
        foreach ($seccion as $key2 => $value) {
            $columna = $columna."<td style=\"padding: 5px;border-width: 2px;\"> ".$value." </td>";
        }
        $fila = $fila."<tr>".$columna."</tr>";
    }
    $cmd = "<table border=\"1px\" style=\"border-collapse: collapse;\">".$fila." </table>";

    print($cmd);

    echo ">>--------- Por Filas ----------><br>";
    foreach ($tabla as $key1 => $seccion) {
        foreach ($seccion as $key2 => $value) {
            echo "(",$key1,",",$key2,") = ",$value,"<br>";
        }
    }
    
    echo ">>-------- Por Columnas --------><br>";
    for ($i=0; $i < count($tabla[0]); $i++) {  
        $suma=0;
        for ($j=0; $j < count($tabla); $j++) {  
            echo "(",$j,",",$i,") = ",$tabla[$j][$i],"<br>";
        }
    }
    
?>

</BODY>
</HTML>
