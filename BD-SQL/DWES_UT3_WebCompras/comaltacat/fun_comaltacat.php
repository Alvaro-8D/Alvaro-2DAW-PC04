<?php
    function nuevaCategoria($nombre){
        $consulta = conexionBD();

        try {
            /* * * * * * Generar Nuevo ID para Nueva Categoria * * * * * * * * */
            $sentencia = $consulta->prepare("select max(id_categoria) ultimo_id from categoria;");
            $sentencia->execute();// ejecuta la sentencia
            $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
            $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
            if($resultado[0]["ultimo_id"] == null){
                echo "esto es NULL";
                $nuevoID = "C-001";
            }else{
                $a = intval(substr($resultado[0]["ultimo_id"],2)) + 1 ; // saca el útimo id y le suma +1 para generar el siguiente ID
                var_dump($a);
                $nuevoID = "C-".str_pad($a,3,0,STR_PAD_LEFT); // saca el útimo id y le suma +1 para generar el siguiente ID
                var_dump($nuevoID);
            }
            //
            //
            ///* * * * * * Insertar Categoría * * * * * * * * */
            //$sentencia = $consulta->prepare("INSERT INTO categoria (id_categoria, nombre) VALUES (:id,:nombre)");
            //$sentencia->bindParam(':id',$nuevoID);// variar parte de la consulta SQL
            //$sentencia->bindParam(':nombre',$nombre);// variar parte de la consulta SQL
            //$sentencia->execute();// ejecuta la sentencia
//
            ///* * * * * * Mostrar Categorías * * * * * * * * */
            //$sentencia = $consulta->prepare("select * from categoria;");
            //$sentencia->execute();// ejecuta la sentencia
            //$sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
            //$resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
            //
            //echo "<h2>Cartegorias</h2>";
            //foreach($resultado as $row) {
            //    echo "Codigo Categoría: " . $row["ID_CATEGORIA"]. " -> Nombre: " . $row["NOMBRE"]. "<br>";
            //}
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    
?>