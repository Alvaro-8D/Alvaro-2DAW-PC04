<HTML>
<HEAD><TITLE>  EJ3AM Arrays</TITLE></HEAD>
<BODY>
<?php
    include '../../Otros/funciones.php'; // inlucye verTabla()
    $tabla = array(array(2, 4, 6, 9, 7),array(8, 10, 12, 1, 12),array(14, 16, 88, 3, 15));
    verTabla($tabla);

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
