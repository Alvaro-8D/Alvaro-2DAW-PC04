<HTML>
<HEAD><TITLE>  EJ7AM Arrays</TITLE></HEAD>
<BODY>
<?php

    $alumnos = array("Pablo" => array("Matematicas"=>5,"Fisica"=>3,"Tecnologia"=>6,"Biologia"=>5),
                    "Maria" => array("Matematicas"=>5,"Fisica"=>4,"Tecnologia"=>2,"Biologia"=>7),
                    "Carlos" => array("Matematicas"=>9,"Fisica"=>8,"Tecnologia"=>10,"Biologia"=>5),
                    "Alba" => array("Matematicas"=>8,"Fisica"=>7,"Tecnologia"=>10,"Biologia"=>8),
                    "Lucia" => array("Matematicas"=>6,"Fisica"=>9,"Tecnologia"=>7,"Biologia"=>8),
                    "Javier" => array("Matematicas"=>4,"Fisica"=>6,"Tecnologia"=>5,"Biologia"=>3),
                    "Sofia" => array("Matematicas"=>10,"Fisica"=>9,"Tecnologia"=>8,"Biologia"=>9),
                    "Diego" => array("Matematicas"=>7,"Fisica"=>5,"Tecnologia"=>6,"Biologia"=>6),
                    "Elena" => array("Matematicas"=>8,"Fisica"=>10,"Tecnologia"=>9,"Biologia"=>7),
                    "Raul" => array("Matematicas"=>3,"Fisica"=>5,"Tecnologia"=>4,"Biologia"=>6));
    
    echo ">>-------- Resultados -------->";
    $guardado = array("nota"=>-1,"nombre"=>"","asignatura"=>"Matematicas");
    foreach ($alumnos as $i => $sec) {
       if($guardado["nota"] < $sec[$guardado["asignatura"]]){
            $guardado["nota"]=$sec[$guardado["asignatura"]]; // guarda la nota max
            $guardado["nombre"]=$i;// guarda el nombre del alumno/a con la nota max
       } 
    }
    echo "<br>a. Mostrar por pantalla el alumno con mayor nota en una asignatura determinada:
    <br>",$guardado["nombre"]," con un ",$guardado["nota"]," en ",$guardado["asignatura"],"<br>";
// >---------------------------------------------------------------------------------------------------------<


    $guardado = array("nota"=>100,"nombre"=>"","asignatura"=>"Fisica");
    foreach ($alumnos as $i => $sec) {
       if($guardado["nota"] > $sec[$guardado["asignatura"]]){
            $guardado["nota"]=$sec[$guardado["asignatura"]]; // guarda la nota min
            $guardado["nombre"]=$i;// guarda el nombre del alumno/a con la nota min
       } 
    }
    echo "<br>b. Mostrar por pantalla el alumno con menor nota en una asignatura determinada:
    <br>",$guardado["nombre"]," con un ",$guardado["nota"]," en ",$guardado["asignatura"],"<br>";
// >---------------------------------------------------------------------------------------------------------<

    $guardado = array("nota"=>100,"nombre"=>"Sofia","asignatura"=>"");
    foreach ($alumnos[$guardado["nombre"]] as $i => $sec) {
       if($guardado["nota"] > $sec){
            $guardado["nota"]=$sec; // guarda la nota min
            $guardado["asignatura"]=$i;// guarda el nombre del alumno/a con la nota min
       } 
    }
    echo "<br>c. Para un alumno, mostrar en que materia tiene su nota más baja:
    <br>",$guardado["nombre"]," con un ",$guardado["nota"]," en ",$guardado["asignatura"],"<br>";
// >---------------------------------------------------------------------------------------------------------<

    $guardado = array("nota"=>-1,"nombre"=>"Alba","asignatura"=>"");
    foreach ($alumnos[$guardado["nombre"]] as $i => $sec) {
       if($guardado["nota"] < $sec){
            $guardado["nota"]=$sec; // guarda la nota min
            $guardado["asignatura"]=$i;// guarda el nombre del alumno/a con la nota min
       } 
    }
    echo "<br>d. Para un alumno, mostrar en que materia tiene su nota más alta:
    <br>",$guardado["nombre"]," con un ",$guardado["nota"]," en ",$guardado["asignatura"],"<br>";
// >-------------------------FALTAAAAAAAAAAAA--------------------------------------------------------------------------------<

    $guardado = array("nota"=>0,"nombre"=>"","asignatura"=>"");
    foreach ($alumnos[$guardado["nombre"]] as $i => $sec) {
       
    }
    echo "<br>e. Mostrar la media por materia de todos los alumnos:
    <br>";
// >----------------------------FALTAAAAAAAAAAAA-----------------------------------------------------------------------------<


    echo "<br>f. Mostrar la media por alumno para todas las materias:
    <br>";

    
?>

</BODY>
</HTML>
