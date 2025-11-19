<?php
    function nuevaCategoria($nombre){
        // Funcion principal del programa, inserta nuevas categorias
        //  y luego muestra todas las categorias de la BD
        $consulta = conexionBD();

        try {
            $nuevoID = ultimo_id(); // Genera un Nuevo ID (NO repetido)
            insertar_categoria($nombre,$nuevoID); // Inserta la Nueva categoría
            mostrar_categorias(); // Mostrar las Categorias de las BD
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function ultimo_id(){
        // Extrae el último ID y devuelve un nuevo ID no repetido a partir del último ID
        $consulta = conexionBD();
        /* * * * * * Generar Nuevo ID para Nueva Categoria * * * * * * * * */
        $sentencia = $consulta->prepare("select max(id_categoria) ultimo_id from categoria;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        if($resultado[0]["ultimo_id"] == null){
            $nuevoID = "C-001";
        }else{
            // saca el útimo id y le suma +1 para generar el siguiente ID
            $nuevoID = "C-".str_pad((intval(substr($resultado[0]["ultimo_id"],2)) + 1),3,0,STR_PAD_LEFT); 
        }
        $conn = null;
        return $nuevoID;
    }

    
    function insertar_categoria($nombre,$nuevoID){ 
        // Pide el nombre y el ID, e inserta la nueva categoria en la BD 
        $consulta = conexionBD();
        /* * * * * * Insertar Categoría * * * * * * * * */
        $sentencia = $consulta->prepare("INSERT INTO categoria (id_categoria, nombre) VALUES (:id,:nombre)");
        $sentencia->bindParam(':id',$nuevoID);// variar parte de la consulta SQL
        $sentencia->bindParam(':nombre',$nombre);// variar parte de la consulta SQL
        $sentencia->execute();// ejecuta la sentencia
        $conn = null;
        return $nuevoID;
    }

    function mostrar_categorias(){ 
        // Extrae todas las Categorias de la BD y las muestra por pantalla
        $consulta = conexionBD();
         /* * * * * * Mostrar Categorías * * * * * * * * */
        $sentencia = $consulta->prepare("select * from categoria order by id_categoria;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        echo "<h2>Cartegorias</h2>";
        foreach($resultado as $row) {
            echo "Codigo Categoría: " . $row["ID_CATEGORIA"]. " -> Nombre: " . $row["NOMBRE"]. "<br>";
        }
        $conn = null;
    }
    
?>