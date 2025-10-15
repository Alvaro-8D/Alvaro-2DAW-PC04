<HTML>
<HEAD><TITLE>  EJ4AM Arrays</TITLE></HEAD>
<BODY>
<?php
    include '../../Otros/funciones.php'; // inlucye verTabla()

    $tabla = array(array(2, 4, 6, 9, 7),array(8, 10, 12, 1, 12),array(14, 16, 88, 3, 15));
    
    verTabla($tabla);

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
