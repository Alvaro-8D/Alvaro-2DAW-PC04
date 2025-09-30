<HTML>
<HEAD><TITLE> EJ4B – Tabla Multiplicar</TITLE></HEAD>
<BODY>
<?php
    $num="8";
    $max = 100; // numero hasta el que hacer la tabla de multiplicar
    for ($i=1; $i <= $max; $i++) { 
        echo $num," x ",$i," = ",($num*$i),"<br>";
    }
?>
</BODY>
</HTML>
