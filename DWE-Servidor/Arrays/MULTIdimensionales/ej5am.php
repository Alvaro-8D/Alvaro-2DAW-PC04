<HTML>
<HEAD><TITLE>  EJ5AM Arrays</TITLE></HEAD>
<BODY>
<?php
    include '../../Otros/funciones.php'; // inlucye verTabla()

    $f = 3; // filas del array
    $c = 5; // columnas del array

    for ($i=0; $i < $f; $i++) {  
        for ($j=0; $j < $c; $j++) {  
            $tabla[$i][$j] = ($i+$j);
        }
    }  

    verTabla($tabla);
    
    echo ">>-------- Por Columnas --------><br>";
    for ($i=0; $i < count($tabla[0]); $i++) {  
        for ($j=0; $j < count($tabla); $j++) {  
            echo "(",$j,",",$i,") = ",$tabla[$j][$i],"<br>";
        }
        echo "<br>";
    }
    
    
?>

</BODY>
</HTML>
