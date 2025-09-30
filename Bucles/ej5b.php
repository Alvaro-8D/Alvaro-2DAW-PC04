<HTML>
<HEAD><TITLE>  EJ5B – Tabla multiplicar con TD</TITLE></HEAD>
<BODY>
<?php
    $num="8";
    $max = 5; // numero hasta el que hacer la tabla de multiplicar
    $cmd = "<table border=\"1px\"> <tr><td>1</td><td>2</td></tr> </table>";
    
    for ($i=1; $i <= $max; $i++) { 
        echo $num," x ",$i," = ",($num*$i),"<br>";
    }

?>

    <table border="1px"> <tr><td>1</td><td>2</td></tr> </table>

</BODY>
</HTML>
