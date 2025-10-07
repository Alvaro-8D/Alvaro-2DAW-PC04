<HTML>
<HEAD><TITLE>  EJ1AM Arrays</TITLE></HEAD>
<BODY>
<?php

    $suma=0; $impares;

    $columna = "";
    $columna2 = "";
    $columna3 = "";
    $fila = "";
    $fila2 = "";
    $cmd = "";

    $j = 1;
    for ($i=0; $i < 20; $i++) {  
        $impares[$i] = $j;
        $j+=2;
    }

    for ($i=0; $i < count($impares); $i++) { 
        $columna = "<td> ".$i." </td>";
        $columna2 = "<td> ".$impares[$i]." </td>";
        $suma = ($impares[$i]+$suma);
        $columna3 = "<td> ".$suma." </td>";
        $fila = "<tr>".$columna.$columna2.$columna3."</tr>";
        $fila2 = $fila2.$fila;
        $cmd = "<table border=\"1px\"> <thead> <td>Índice</td>  <td>Valor</td>  <td>Suma</td> </thead>".$fila2." </table>";
    }

    print($cmd);
?>


</BODY>
</HTML>
