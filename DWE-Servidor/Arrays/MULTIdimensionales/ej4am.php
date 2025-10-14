<HTML>
<HEAD><TITLE>  EJ4AM Arrays</TITLE></HEAD>
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

    $n=-1;
    echo ">>--------- Elemento Mayor ----------><br>";
    foreach ($tabla as $key1 => $seccion) {
        foreach ($seccion as $key2 => $value) {
            if ($n < $value) {
                $n = $value;
                $n1=$key1; // Guarda la fila
                $n2=$key2; // Guarda la columna
                
            }
        }
    }
    echo "(",$n1,",",$n2,") = ",$n,"<br>";
    
    
?>

</BODY>
</HTML>
