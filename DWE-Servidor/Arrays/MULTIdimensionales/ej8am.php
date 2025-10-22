<HTML>
<HEAD><TITLE>  EJ8AM Arrays</TITLE>
<link href="./"></HEAD>
<BODY>
<?php
    include '../../Otros/funciones.php'; // inlucye verTabla()verTabla($tabla);

    $f = 3; // filas del array
    $c = 1; // columnas del array

    for ($i=0; $i < $f; $i++) {  // Matriz 1
        for ($j=0; $j < $c; $j++) {  
            $tabla[$i][$j] = random_int(0,3);
        }
    } 
    for ($i=0; $i < $c; $i++) {  // Matriz 2
        for ($j=0; $j < $f; $j++) {  
            $tabla2[$i][$j] = random_int(0,3);
        }
    } 
    $tabla3 = $tabla2; // $tabla3, es la matriz variable sobre la que mostraremos el resultado d elas operaciones

    echo "<h2>Matriz 1</h2>";
    verTabla($tabla);
    echo "<br><h2>Matriz 2</h2>";
    verTabla($tabla2);
/****************************************** 
    foreach ($tabla as $i => $seccion) {
        foreach ($seccion as $j => $value) {
             $tabla3[$i][$j] += $value;
        } 
    }

    // El resultado de la suma lo he guardado en $tabla3
    echo "<br><h2>Suma</h2>"; // SUMA DE MATRICES
    verTabla($tabla3); 
/* -------------------------------------------------------------------- */
    $lista1; $lista2; // [a][b][c]
    $lista3 = 0; // prducto de $lista1 y $lista2

    for($i = 0; $i<count($tabla); $i++) {
        $lista1[$i] = $tabla[$i][0];
        echo "<br>\$i = ",$tabla[$i][0];
    }
    echo "<br>-----------------------------------<br>";
    for($i = 0; $i<count($tabla2[0]); $i++) {
        $lista2[$i] = $tabla2[0][$i];
        echo "<br>\$i = ",$tabla2[0][$i];
    }
/* 00000000000000000000000000000000000000000000000000000000 */
    for($i = 0; $i<count($tabla2); $i++) {
        $lista3 +=  $lista1[$i] * $lista2[$i];
    }

    echo "<br>---->",$lista3;"<br>";
/* 1111111111111111111111111111111111111111111111111111111 */
    for($i = 0; $i<count($tabla2[0]); $i++) {
        $lista2[$i] = $tabla2[0][$i];
        echo "<br>\$i = ",$tabla2[0][$i];
    }

    for($i = 0; $i<count($tabla2); $i++) {
        $lista3 +=  $lista1[$i] * $lista2[$i];
    }

    echo "<br>---->",$lista3;"<br>";
/* 222222222222222222222222222222222222222222222222222222222 */
    for($i = 0; $i<count($tabla2[0]); $i++) {
        $lista2[$i] = $tabla2[0][$i];
        echo "<br>\$i = ",$tabla2[0][$i];
    }

    for($i = 0; $i<count($tabla2); $i++) {
        $lista3 +=  $lista1[$i] * $lista2[$i];
    }

    echo "<br>---->",$lista3;"<br>";
    


    echo "<br><h2>Producto</h2>";// FALTA HAACER EL PRODUCTO
    verTabla($tabla2);

    
    
    
?>

</BODY>
</HTML>
