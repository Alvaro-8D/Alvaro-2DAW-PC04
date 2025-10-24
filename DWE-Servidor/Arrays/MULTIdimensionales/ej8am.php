<HTML>
<HEAD><TITLE>  EJ8AM Arrays</TITLE>
<link href="./"></HEAD>
<BODY>
<?php
    include '../../Otros/funciones.php'; // inlucye verTabla()verTabla($tabla);

    $f = 3; // filas del array
    $c = 3; // columnas del array

    for ($i=0; $i < $f; $i++) {  // Matriz 1
        for ($j=0; $j < $c; $j++) {  
            $tabla1[$i][$j] = random_int(0,10);
        }
    } 
    for ($i=0; $i < $c; $i++) {  // Matriz 2
        for ($j=0; $j < $f; $j++) {  
            $tabla2[$i][$j] = random_int(0,10);
        }
    }  
    echo "<h2>Matriz 1</h2>";
    verTabla($tabla1);
    echo "<br><h2>Matriz 2</h2>";
    verTabla($tabla2);

    $tabla3 = $tabla2; // $tabla3, es la matriz variable sobre la que mostraremos el resultado de la suma
    foreach ($tabla1 as $i => $seccion) {
        foreach ($seccion as $j => $value) {
             $tabla3[$i][$j] += $value;
        } 
    }

    // El resultado de la suma lo he guardado en $tabla3
    echo "<br><h2>Suma</h2>"; // SUMA DE MATRICES
    verTabla($tabla3); 
/* -------------------------------------------------------------------- */

/*
Leyenda:

    count($tabla1) = filas
    count($tabla1[0]) = columnas

    tabla[filas][columnas]
*/ 
    for ($i=0; $i < $f; $i++) {  // Matriz 4 para guardar Producto (lko inicializo a 0)
        for ($j=0; $j < $f; $j++) {  
            $tabla4[$i][$j] = 0;
        }
    }
    for ($fila=0; $fila < count($tabla1); $fila++) { 
        for ($columna=0; $columna < count($tabla2[0]); $columna++) { 
            $ja = $fila; // filas
            $jb = $columna; // columnas
            for ($i=0; $i < count($tabla1[0]); $i++) { 
              $tabla4[$fila][$columna]+= $tabla1[$ja][$i] * $tabla2[$i][$jb];  
            }
        }
    }

    echo "<br><h2>Producto</h2>";
    verTabla($tabla4);

    
    
    
?>

</BODY>
</HTML>
