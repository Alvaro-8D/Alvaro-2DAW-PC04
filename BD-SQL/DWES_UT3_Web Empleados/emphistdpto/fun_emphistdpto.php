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

    function  verListadoActual($depart){
        // Funcion principal del programa, da de alta empleados y les asigna un departamento
        $consulta = conexionBD();
        try {
            ver_dpto($consulta,$depart); // Añande fecha de FIN a un Empleado en un departamento
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

    function ver_dpto($consulta,$depart){ 
        // Asigna un empleado a un departamento
        $sentencia = $consulta->prepare("SELECT CONCAT('+ ', e.nombre, ' (', e.dni, ') | ',fecha_ini,' > ',fecha_fin) 
                                        AS frase, d.nombre_dpto AS nombre_dpto
                                        FROM emple_depart ed,departamento d, empleado e
                                        WHERE fecha_fin IS NOT NULL AND ed.cod_dpto = :cod_dpto 
                                        AND e.dni = ed.dni AND d.cod_dpto = ed.cod_dpto;");
        $sentencia->bindParam(':cod_dpto',$depart);
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$sentencia->fetchAll();
        if($resultado !== array()){
            echo "<h2> Histórico del Departamento [ ",$resultado[0]["nombre_dpto"]," ]: </h2>";  
            foreach ($resultado as $key => $value) {
                echo $value["frase"],"<br>";
            }
        }else{ echo "<h2>No ha habido cambios de departamento</h2>";}
        $consulta = null;
    }
    
?>