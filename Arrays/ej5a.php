<HTML>
<HEAD><TITLE>EJ5AM Arrays</TITLE></HEAD>
<BODY>

<?php

    $cadena1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
    $cadena2 = array("Sistemas Informáticos", "FOL", "Mecanizado");
    $cadena3 = array("Desarrollo Web ES", "Desarrollo Web EC", "Desarrollo Interfaces","Inglés");

    
    // a. Unir los 3 arrays en uno único sin utilizar funciones de arrays
    print("<h3>a. Unir los 3 arrays en uno único sin utilizar funciones de arrays</h3>");
    $union = array($cadena1[0],$cadena1[1],$cadena1[2],$cadena2[0],$cadena2[1],$cadena2[2],$cadena3[0],$cadena3[1],$cadena3[2],$cadena3[3]);
    for ($i=0; $i < 10; $i++) { 
        print("[".$i."] --> ".$union[$i]."<br>");
    }

    // b. Unir los 3 arrays en uno único usando la función array_merge()
    print("<h3>b. Unir los 3 arrays en uno único usando la función array_merge()</h3>");
    $union = array_merge($cadena1,$cadena2,$cadena3);
    for ($i=0; $i < 10; $i++) { 
        print("[".$i."] --> ".$union[$i]."<br>");
    }

    // c. Unir los 3 arrays en uno único usando la función array_push()
    print("<h3>c. Unir los 3 arrays en uno único usando la función array_push()</h3>");
    array_push($cadena1,$cadena2[0],$cadena2[1],$cadena2[2],$cadena3[0],$cadena3[1],$cadena3[2],$cadena3[3]);;
    for ($i=0; $i < 10; $i++) { 
        print("[".$i."] --> ".$union[$i]."<br>");
    }


?>

</BODY>
</HTML>
