<?php
    function nuevaCategoria($nombre){
        $consulta = conexionBD();

        try {
            $sentencia = $consulta->prepare("INSERT INTO categoria (ID_CATEGORIA, NOMBRE) VALUES (:id,:nombre)");

            $sentencia->bindParam(':id',$nuevoID);// variar parte de la consulta SQL
            $sentencia->bindParam(':nombre',$nombre);// variar parte de la consulta SQL
            
            $nuevoID = 5;
            $sentencia = $consulta->prepare("select max(id_categoria) ultimo_id from categoria;");
            // set the resulting array to associative
            $sentencia->execute();// ejecuta la sentencia
            $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
            $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
            //$nuevoID = $resultado["ultimo_id"][0];
            var_dump($resultado["ultimo_id"][0]);

            $sentencia->execute();// ejecuta la sentencia

            $sentencia = $consulta->prepare("select * from categoria;");
            // set the resulting array to associative
            $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
            $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo

            echo "<h2>Cartegorias</h2>";
            foreach($resultado as $row) {
                echo "Codigo Categoría: " . $row["id_categoria"]. " -> Nombre: " . $row["nombre"]. "<br>";
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    
?>