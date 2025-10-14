<HTML>
<HEAD><TITLE>  EJ1AM Arrays</TITLE></HEAD>
<BODY>
<?php

    $impares;
    $fila = "";

    $k = 2;
    for ($i=0; $i < 3; $i++) {  
        for ($j=0; $j < 3; $j++) {  
            $impares[$i][$j] = $k;       
            $k+=2;
        }
    }

    foreach ($impares as $key1 => $seccion) {
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
