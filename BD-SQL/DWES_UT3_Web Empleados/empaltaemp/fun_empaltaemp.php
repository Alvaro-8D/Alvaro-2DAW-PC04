<?php
    function extraerDepartamentos(){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("select cod_dpto,nombre_dpto from departamento order by cod_dpto;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo    
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["cod_dpto"],"\">",$value["nombre_dpto"],"</option>";
        }
        $consulta = null;
    }
    
    function  nuevoEmpleado($nombre,$apellidos,$dni,$fecna,$salario,$depart){
        // Funcion principal del programa, da de alta empleados y les asigna un departamento
        $consulta = conexionBD();
        try {
            insertar_emp($consulta,$nombre,$apellidos,$dni,$fecna,$salario); // Inserta el Nuevo Empleado 
            asignar_dpto($consulta,$dni,$depart); // Asigna un Departamento al nuevo empleado
        }
        catch(PDOException $e) {
            if($e->getCode() == "23000"){
                echo "NO puede haber dos Empleados con el MISMO DNI";
            }else{
               echo "Error: " . $e->getMessage(); 
            }
            $consulta->rollBack();
        }
        $consulta = null;
    }

    function insertar_emp($consulta,$nombre,$apellidos,$dni,$fecna,$salario){ 
        // Añade el nuevo empleado a la BD
        $consulta->beginTransaction();
        $sentencia = $consulta->prepare("INSERT INTO empleado (dni, nombre, apellidos, fecha_nac, salario) 
                                            VALUES (:dni, :nombre, :apellidos, :fecha_nac, :salario)");
        $sentencia->bindParam(':dni',$dni);
        $sentencia->bindParam(':nombre',$nombre);
        $sentencia->bindParam(':apellidos',$apellidos);
        $sentencia->bindParam(':fecha_nac',$fecna);
        $sentencia->bindParam(':salario',$salario);
        $sentencia->execute();
        $consulta->commit();
        $consulta = null;
    }

    function asignar_dpto($consulta,$dni,$cod_dpto){ 
        // Asigna un empleado a un departamento
        $consulta->beginTransaction();
        $sentencia = $consulta->prepare("INSERT INTO emple_depart (dni, cod_dpto, fecha_ini, fecha_fin) 
                                            VALUES (:dni, :cod_dpto, :fecha_ini, NULL)");
        $sentencia->bindParam(':dni',$dni);
        $sentencia->bindParam(':cod_dpto',$cod_dpto);
        $fecha_ini = date('Y-m-d'); // fecha actual
        $sentencia->bindParam(':fecha_ini',$fecha_ini);
        $sentencia->execute();
        $consulta->commit();
        $consulta = null;
    }
    
?>