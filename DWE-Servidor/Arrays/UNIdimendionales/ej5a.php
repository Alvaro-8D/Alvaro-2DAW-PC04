<HTML>
<HEAD><TITLE>EJ5AM Arrays</TITLE></HEAD>
<BODY>

<?php

    $cadena1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
    $cadena2 = array("Sistemas Informáticos", "FOL", "Mecanizado");
    $cadena3 = array("Desarrollo Web ES", "Desarrollo Web EC", "Desarrollo Interfaces","Inglés");

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
    foreach($union as $i => $value) {
        print("[".$i."] --> ".$value."<br>");
    }

    print("<h3>b. Unir los 3 arrays en uno único usando la función array_merge()</h3>");
    $union = array_merge($cadena1,$cadena2,$cadena3);
    foreach($union as $i => $value) {
        print("[".$i."] --> ".$union[$i]."<br>");
    }

    print("<h3>c. Unir los 3 arrays en uno único usando la función array_push()</h3>");
    foreach($cadena2 as $i => $value) { 
        array_push($cadena1,$value);
    }
    foreach($cadena3 as $i => $value) { 
        array_push($cadena1,$value); 
    }
    foreach($cadena1 as $i => $value) { 
        print("[".$i."] --> ".$cadena1[$i]."<br>");
    }


?>

</BODY>
</HTML>
