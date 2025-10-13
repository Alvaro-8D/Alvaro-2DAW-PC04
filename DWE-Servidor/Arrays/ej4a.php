<HTML>
<HEAD><TITLE>EJ4AM Arrays</TITLE></HEAD>
<BODY>
<?php

    $j = 1;
    for ($i=19; $i >= 0; $i--) {  
        $binarios[$i] = sprintf("%b",$j);
        $j ++;
    }
$fila2 = "";
    foreach ($binarios as $i => $value) {
        $columna = "<td> ".$i." </td>";
        $columna2 = "<td> ".$value." </td>";
        $columna3 = "<td> ".base_convert($value,2,8)." </td>";
        $fila = "<tr>".$columna.$columna2.$columna3."</tr>";
        $fila2 = $fila2.$fila;
        $cmd = "<table border=\"1px\"> <thead> <td>Índice</td>  <td>Valor</td>  <td>Octal</td> </thead>".$fila2." </table>";
    }

    print($cmd);
?>


</BODY>
</HTML>
