<HTML>
<HEAD><TITLE>EJ3AM Arrays</TITLE></HEAD>
<BODY>
<?php

    for ($i=0; $i < 20; $i++) {  
        $binarios[$i] = sprintf("%b",$i);
    }

    for ($i=0; $i < 20; $i++) { 
        $columna = "<td> ".$i." </td>";
        $columna2 = "<td> ".$binarios[$i]." </td>";
        $columna3 = "<td> ".base_convert($binarios[$i],2,8)." </td>";
        $fila = "<tr>".$columna.$columna2.$columna3."</tr>";
        $fila2 = $fila2.$fila;
        $cmd = "<table border=\"1px\"> <thead> <td>Índice</td>  <td>Valor</td>  <td>Octal</td> </thead>".$fila2." </table>";
    }

    print($cmd);
?>


</BODY>
</HTML>
