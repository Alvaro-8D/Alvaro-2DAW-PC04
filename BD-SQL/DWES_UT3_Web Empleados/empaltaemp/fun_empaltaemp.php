<?php
    function  nuevoDepartamento($nombre){
        // Funcion principal del programa, da de alta departamentos
        $consulta = conexionBD();
        try {
            $nuevoID = ultimo_id($consulta); // Genera un Nuevo ID (NO repetido)          
            insertar_dpto($consulta,$nombre,$nuevoID); // Inserta el Nuevo Producto 
            mostrar_dpto($consulta); // Mostrar las Categorias de las BD
        }
        catch(PDOException $e) {
            if($e->getCode() == "23000"){
                echo "NO puede haber dos Departamentos con el MISMO CÓDIGO";
            }else{
               echo "Error: " . $e->getMessage(); 
            }
            $consulta->rollBack();
            
        }
        $consulta = null;
    }

    function ultimo_id($consulta){
        // Extrae el último ID y devuelve un nuevo ID no repetido a partir del último ID
        $sentencia = $consulta->prepare("select max(cod_dpto) ultimo_id from departamento;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        if($resultado[0]["ultimo_id"] == null){
            $nuevoID = "D001";
        }else{
            // saca el útimo id y le suma +1 para generar el siguiente ID
            $nuevoID = "D".str_pad(intval(substr($resultado[0]["ultimo_id"],1))+1,3,0,STR_PAD_LEFT); 
        }
        $consulta = null;
        return $nuevoID;
    }

    function insertar_dpto($consulta,$nombre,$nuevoID){ 
        // Pide el nombre y el ID, e inserta el nuevo producto en la BD 
        $consulta->beginTransaction();
        $sentencia = $consulta->prepare("INSERT INTO departamento (cod_dpto, nombre_dpto) 
                                            VALUES (:codigo,:nombre)");

        // $nuevoID='D011';// PRUEBA PARA METER UNA CLAVE DUCPLICADA

        $sentencia->bindParam(':codigo',$nuevoID);// variar parte de la consulta SQL
        $sentencia->bindParam(':nombre',$nombre);// variar parte de la consulta SQL
        $sentencia->execute();// ejecuta la sentencia
        $consulta->commit();
        $consulta = null;
    }

    function mostrar_dpto($consulta){ 
        // Extrae todas los Productos de la BD y las muestra por pantalla
        $sentencia = $consulta->prepare("select cod_dpto,nombre_dpto from departamento order by cod_dpto;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        echo "<h2>Productos</h2>";
        foreach($resultado as $row) {
            echo "Codigo Departamento: ".$row["cod_dpto"]."<br>-> Nombre: ".$row["nombre_dpto"]."<br>>>>---------------------------------><br>";
        }
        $consulta = null;
    }
    
?>