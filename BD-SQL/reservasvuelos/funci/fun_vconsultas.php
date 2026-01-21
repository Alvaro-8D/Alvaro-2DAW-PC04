<?php 
    function extraerReservas(){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("SELECT distinct id_reserva from reservas 
                                        WHERE dni_cliente = :dni_cliente;");
        $sentencia->bindParam(':dni_cliente',$_COOKIE['id_cliente']);
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["id_reserva"],"\">",$value["id_reserva"],"</option>";
        }
        $consulta = null;
    }

    function resultado($id_reserva){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("SELECT *  FROM reservas 
                                        WHERE dni_cliente = :dni_cliente and id_reserva = :id_reserva;");
        $sentencia->bindParam(':dni_cliente',$_COOKIE['id_cliente']);
        $sentencia->bindParam(':id_reserva',$id_reserva);
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
        var_dump($resultado);
        $consulta = null;
    }

?>