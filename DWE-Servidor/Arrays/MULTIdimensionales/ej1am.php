<HTML>
<HEAD><TITLE>  EJ1AM Arrays</TITLE></HEAD>
<BODY>
<?php
    include '../../Otros/funciones.php'; // inlucye verTabla()
    $pares;

    $k = 2;
    for ($i=0; $i < 3; $i++) {  
        for ($j=0; $j < 3; $j++) {  
            $pares[$i][$j] = $k;       
            $k+=2;
        }
    }

    verTabla($pares);
?>


</BODY>
</HTML>
