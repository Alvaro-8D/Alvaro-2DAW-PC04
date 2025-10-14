<HTML>
<HEAD><TITLE>EJ6AM Arrays</TITLE></HEAD>
<BODY>
<?php

    $cadena1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
    $cadena2 = array("Sistemas Informáticos", "FOL", "Mecanizado");
    $cadena3 = array("Desarrollo Web ES", "Desarrollo Web EC", "Desarrollo Interfaces","Inglés");

    array_splice($cadena2, 2, 1);
// COPIAR EL EJ 5 YA ARREGLADO Y HACER DE NUEVO EL EJ 6 PERO BIEN HECHO

    print("<h3>a. Unir los 3 arrays en uno único sin utilizar funciones de arrays</h3>");
    $n = 0;
    foreach($cadena1 as $i => $value) { 
        $union[$n]=$value;
        $n++;
    }
    foreach($cadena2 as $i => $value) { 
        $union[$n]=$value;
        $n++;
    }
    foreach($cadena3 as $i => $value) { 
        $union[$n]=$value;
        $n++;  
    }
    foreach(array_reverse($union) as $i => $value) {
        print("[".$i."] --> ".$value."<br>");
    }
    
    print("<h3>b. Unir los 3 arrays en uno único usando la función array_merge()</h3>");
    $union = array_merge($cadena1,$cadena2,$cadena3);
    foreach(array_reverse($union) as $i => $value) {
        print("[".$i."] --> ".$value."<br>");
    }


    print("<h3>c. Unir los 3 arrays en uno único usando la función array_push()</h3>");
    
    foreach($cadena2 as $i => $value) { 
        array_push($cadena1,$value);
    }
    foreach($cadena3 as $i => $value) { 
        array_push($cadena1,$value); 
    }
    foreach(array_reverse($cadena1) as $i => $value) { 
        print("[".$i."] --> ".$value."<br>");
    }     

?>


</BODY>
</HTML>
