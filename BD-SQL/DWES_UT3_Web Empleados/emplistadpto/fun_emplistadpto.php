<?php
    function extraerDepartamentos(){
        $consulta = conexionBD();
        // Extrae los departamentos de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("select cod_dpto,nombre_dpto from departamento order by cod_dpto;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo    
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["cod_dpto"],"\">",$value["nombre_dpto"],"</option>";
        }
        $consulta = null;
    }

    function extraerEmpleados(){
        $consulta = conexionBD();
        // Extrae los empleados de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("select dni,nombre from empleado order by dni;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo    
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["dni"],"\">",$value["dni"]," (",$value["nombre"],")</option>";
        }
        $consulta = null;
    }
    
    function  nuevoDepartamento($dni,$depart){
        // Funcion principal del programa, da de alta empleados y les asigna un departamento
        $consulta = conexionBD();
        try {
            $consulta->beginTransaction();
            fin_dpto($consulta,$dni); // Añande fecha de FIN a un Empleado en un departamento
            asignar_dpto($consulta,$dni,$depart); // Asigna un Departamento al nuevo empleado
            $consulta->commit();
        }
        catch(PDOException $e) {
            if($e->getCode() == "23000"){
                echo "NO Repetir el MISMO empleado en el MISMO departamento en la MISMA fecha";
            }else{
               echo "Error: " . $e->getMessage(); 
            }
            $consulta->rollBack();
        }
        $consulta = null;
    }

    function fin_dpto($consulta,$dni){ 
        // Asigna un empleado a un departamento
        $sentencia = $consulta->prepare("UPDATE emple_depart
                                            SET fecha_fin = :fecha_fin
                                            WHERE dni = :dni AND fecha_fin IS NULL;");
        $sentencia->bindParam(':dni',$dni);
        $fecha_fin = date('Y-m-d'); // fecha actual
        $sentencia->bindParam(':fecha_fin',$fecha_fin);
        $sentencia->execute();
        $consulta = null;
    }

    function asignar_dpto($consulta,$dni,$cod_dpto){ 
        // Asigna un empleado a un departamento
        $sentencia = $consulta->prepare("INSERT INTO emple_depart (dni, cod_dpto, fecha_ini, fecha_fin) 
                                            VALUES (:dni, :cod_dpto, :fecha_ini, NULL)");
        $sentencia->bindParam(':dni',$dni);
        $sentencia->bindParam(':cod_dpto',$cod_dpto);
        $fecha_ini = date('Y-m-d'); // fecha actual
        $sentencia->bindParam(':fecha_ini',$fecha_ini);
        $sentencia->execute();
        $consulta = null;
    }
    
?>