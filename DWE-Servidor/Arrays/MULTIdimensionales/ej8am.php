<HTML>
<HEAD><TITLE>  EJ8AM Arrays</TITLE>
<link href="./"></HEAD>
<BODY>
<?php
    include '../../Otros/funciones.php'; // inlucye verTabla()verTabla($tabla);

    $f = 2; // filas del array
    $c = 2; // columnas del array

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

    foreach ($tabla as $i => $seccion) {
        foreach ($seccion as $j => $value) {
             $tabla3[$i][$j] += $value;
        } 
    }

    // El resultado de la suma lo he guardado en $tabla3
    echo "<br><h2>Suma</h2>"; // SUMA DE MATRICES
    verTabla($tabla3); 
/* -------------------------------------------------------------------- */
    
    echo "<br><h2>Producto</h2>";// FALTA HACER EL PRODUCTO
    verTabla($tabla2);

    
    
    
?>

</BODY>
</HTML>
