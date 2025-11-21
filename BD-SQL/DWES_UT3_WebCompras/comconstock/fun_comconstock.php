<?php
    function extraerCategorias(){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("select * from categoria order by id_categoria;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo    
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["ID_CATEGORIA"],"\">",$value["NOMBRE"],"</option>";
        }
        $consulta = null;
    }
  
    function  nuevoProducto($nombre,$precio,$categoria){
        // Funcion principal del programa, da de alta productos
        $consulta = conexionBD();
        try {
            $nuevoID = ultimo_id($consulta); // Genera un Nuevo ID (NO repetido)            
            insertar_producto($consulta,$nombre,$nuevoID,$precio,$categoria); // Inserta el Nuevo Producto 
            mostrar_producto($consulta); // Mostrar las Categorias de las BD
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function ultimo_id($consulta){
        // Extrae el último ID y devuelve un nuevo ID no repetido a partir del último ID
        $sentencia = $consulta->prepare("select max(id_producto) ultimo_id from producto;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        if($resultado[0]["ultimo_id"] == null){
            $nuevoID = "P0001";
        }else{
            // saca el útimo id y le suma +1 para generar el siguiente ID
            $nuevoID = "P".str_pad((intval(substr($resultado[0]["ultimo_id"],1))+1),4,0,STR_PAD_LEFT); 
        }
        $consulta = null;
        return $nuevoID;
    }

    function insertar_producto($consulta,$nombre,$nuevoID,$precio,$categoria){ 
        // Pide el nombre y el ID, e inserta el nuevo producto en la BD 
        $sentencia = $consulta->prepare("INSERT INTO producto (id_producto, nombre, precio, id_categoria) 
                                            VALUES (:id,:nombre,:precio,:id_categoria)");
        $sentencia->bindParam(':id',$nuevoID);// variar parte de la consulta SQL
        $sentencia->bindParam(':nombre',$nombre);// variar parte de la consulta SQL
        $sentencia->bindParam(':precio',$precio);// variar parte de la consulta SQL
        $sentencia->bindParam(':id_categoria',$categoria);// variar parte de la consulta SQL
        $sentencia->execute();// ejecuta la sentencia
        return $nuevoID;
        $consulta = null;
    }

    function mostrar_producto($consulta){ 
        // Extrae todas los Productos de la BD y las muestra por pantalla
        $sentencia = $consulta->prepare("select * from producto order by id_producto;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        echo "<h2>Productos</h2>";
        foreach($resultado as $row) {
            echo "Codigo Producto: ".$row["ID_PRODUCTO"]."<br>-> Nombre: ".$row["NOMBRE"]."<br>-> Precio: ";
            echo $row["PRECIO"]."<br>-> Nombre: ".$row["ID_CATEGORIA"]."<br>>>>---------------------------------><br>";
        }
        $consulta = null;
    }
    
?>