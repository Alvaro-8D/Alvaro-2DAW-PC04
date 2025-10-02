<HTML>
<HEAD><TITLE>EJ7AM Arrays</TITLE></HEAD>
<BODY>
<?php

    $alumnos = array("Pablo"=>19,"Carlos" => 300,"Miguel" => 20,"Rizwan" => 21,"Charlie" => 17,);

    print("<h3>a. Mostrar el contenido del array utilizando bucles</h3>");
    foreach ($alumnos as $a => $b) {
        print("[".$a."] --> ".$b."<br>");
    }  
        
    print("<h3>b. Sitúa el puntero en la segunda posición del array y muestra su valor</h3>"); 
    print("Segunda Clave del Array --> ".array_values($alumnos)[1]."<br>");

    print("<h3>c. Avanza una posición y muestra el valor</h3>");
    print(" Avanza Una posición el Array --> ".next($alumnos)."<br>");

    print("<h3>d. Coloca el puntero en la última posición y muestra el valor</h3>");
    print("Última Clave del Array --> ".array_key_last($alumnos)."<br>");

    print("<h3>e. Ordena el array por orden de edad (de menor a mayor) y muestra la primera posición del array y la última</h3>");
    asort($alumnos);
    print("Primera Clave del Array --> ".array_key_first($alumnos)."<br>");
    print("Última Clave del Array --> ".array_key_last($alumnos)."<br>");

?>


</BODY>
</HTML>
