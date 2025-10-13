<HTML>
<HEAD><TITLE>EJ2AM Arrays</TITLE></HEAD>
<BODY>
<?php

    $suma=0; $impares;  // TERMINAR EJERCICIO

    $columna = "";
    $columna2 = "";
    $columna3 = "";
    $fila = "";
    $fila2 = "";
    $cmd = "";

    $j = 1;
    for ($i=0; $i < 20; $i++) {  
        $impares[$i] = $j;
        $j+=2;
    }

    for ($i=0; $i < count($impares); $i++) { 
        $columna = "<td> ".$i." </td>";
        $columna2 = "<td> ".$impares[$i]." </td>";
        $suma = ($impares[$i]+$suma);
        $columna3 = "<td> ".$suma." </td>";
        $fila = "<tr>".$columna.$columna2.$columna3."</tr>";
        $fila2 = $fila2.$fila;
        $cmd = "<table border=\"1px\"> <thead> <td>Índice</td>  <td>Valor</td>  <td>Suma</td> </thead>".$fila2." </table>";
    }

    print($cmd);

    //  media de los valores que están en las posiciones pares y las posiciones impares
    $media1 = 0;
    $media2 = 0;
    for ($i=0; $i < count($impares); $i ++) {    
        if ($i%2 == 0){
            $media1 += $impares[$i]; // PARES
        }
        else{
            $media2 += $impares[$i]; // IMPARES
        }
    }
    $m1 = $media1;
    $m2 = $media2;
    
    if (count($impares)%2 == 0){
        $media1 = $media1/(count($impares)/2);
        $media2 = $media2/(count($impares)/2);
    }
    else{
        $media2 = $media2/((int)(count($impares)/2));
        $media1 = $media1/((int)(count($impares)/2)+1);
        echo $media1," = ",$media1,"/","(",count($impares),"/",2,")<br>";
    }

    echo "Media de Posiciones Impares del Array: ",$m2," / ",((int)(count($impares)/2))," = ",$media2,"<br>";
    echo "Media de Posiciones Pares del Array: ",$m1," / ",((int)(count($impares)/2)+1)," = ",$media1,"<br>";


?>


</BODY>
</HTML>
