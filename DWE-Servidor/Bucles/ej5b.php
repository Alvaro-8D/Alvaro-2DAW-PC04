<HTML>
<HEAD><TITLE>  EJ5B – Tabla multiplicar con TD</TITLE></HEAD>
<BODY>
<?php
    $num="8";
    $max = 10; // numero hasta el que hacer la tabla de multiplicar
 
    $columna = "";
    $columna2 = "";
    $fila = "";
    $fila2 = "";
    $cmd = "";

    for ($i=1; $i <= $max; $i++) { 
        $columna = "<td> ".$num." x ".$i." </td>";
        $columna2 = "<td> ".($num*$i)." </td>";
        $fila = "<tr>".$columna.$columna2."</tr>";
        $fila2 = $fila2.$fila;
        $cmd = "<table border=\"1px\"> ".$fila2." </table>";
    }

    print($cmd);
?>


</BODY>
</HTML>
