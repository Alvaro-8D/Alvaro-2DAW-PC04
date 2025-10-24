<HTML>
<HEAD><TITLE>  EJ9AM Arrays</TITLE>
<link href="./"></HEAD>
<BODY>
<?php
    include '../../Otros/funciones.php'; // inlucye verTabla();
/*
Leyenda:

    count($tabla1) = filas
    count($tabla1[0]) = columnas

    tabla[filas][columnas]
*/ 

    $f = 3; // filas del array
    $c = 3; // columnas del array

    for ($i=0; $i < $f; $i++) {  // Matriz 1
        for ($j=0; $j < $c; $j++) {  
            $tabla1[$i][$j] = random_int(0,10);
        }
    } 
    
    /*  * * * * * * * * Matriz Traspuesta  * * * * * * * * */
    foreach ($tabla1 as $key1 => $sec) {
        foreach ($sec as $key2 => $value) {
            $tabla2[$key1][$key2] = $tabla1[$key2][$key1];
        }
    }
    /*  * * * * * * * * Matriz Traspuesta  * * * * * * * * */

    echo "<h2>Matriz</h2>";
    verTabla($tabla1);

    echo "<br><h2>Matriz Traspuesta</h2>";
    verTabla($tabla2);
    
?>

</BODY>
</HTML>
