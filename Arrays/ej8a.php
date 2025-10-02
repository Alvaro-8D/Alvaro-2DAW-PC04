<HTML>
<HEAD><TITLE>EJ8AM Arrays</TITLE></HEAD>
<BODY>
<?php

    $alumnos = array("Pablo"=>5,"Carlos" => 4,"Miguel" => 9,"Rizwan" => 6,"Charlie" => 8,);
    $alu = array();
    
    print("<h3>a. Mostrar el alumno con mayor nota</h3>");
    $anterior = (-1);
    $anterior2;
    foreach ($alumnos as $key => $value) {
        if ($value > $anterior) {
            $anterior = $value;
            $anterior2 = $key;
        }
    }
    print(" Alumno con MÁS nota  --> ".$anterior2." con ".$anterior."<br>");

    print("<h3>b. Mostrar el alumno con menor nota</h3>");
    $anterior = 100000;
    $anterior2;
    foreach ($alumnos as $key => $value) {
        if ($value < $anterior) {
            $anterior = $value;
            $anterior2 = $key;
        }
    }

    print(" Alumno con MENOS nota  --> ".$anterior2." con ".$anterior."<br>");

    print("<h3>c. Media notas obtenidas por los alumnos</h3>");

    $suma = 0;
    foreach ($alumnos as $key => $value) {
        $suma += $value;
    }

    $suma = $suma/count($alumnos);

    print(" Media de las Notas de los Alumnos  --> ".$suma."<br>");


    
?>


</BODY>
</HTML>
