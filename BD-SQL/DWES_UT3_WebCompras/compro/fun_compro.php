<?php
    function extraerClientes(){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("select NIF,NOMBRE from cliente order by NIF;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo   
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["NIF"],"\">",$value["NOMBRE"],"(",$value["NIF"],")","</option>";
        }
        $consulta = null;
    }

    function extraerProductos(){
        $consulta = conexionBD();
        // Extrae las categorias de la BD y las muestra en el HTMl
        $sentencia = $consulta->prepare("select ID_PRODUCTO,NOMBRE from producto order by id_producto;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo    
        foreach ($resultado as $key => $value) {
            echo "<option value=\"",$value["ID_PRODUCTO"],"\">",$value["NOMBRE"],"</option>";
        }
        $consulta = null;
    }

    function comprarProducto($cliente,$producto,$cantidad,$fechaCom){
        // Funcion principal del programa, dá de alta clientes
        $consulta = conexionBD();
        try {
            $stock = comprobar_stock($consulta,$producto,$cantidad); // true = SI hay stock
            if ($stock){
                guardar_compra($consulta,$cliente,$producto,$cantidad,$fechaCom); // registra la compra en la BD
                restar_productos($consulta,$cantidad,$producto); //restar productos comprados del almacen
            }
            mostrar_compras($consulta);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $consulta = null;
    }

    function comprobar_stock($consulta,$producto,$cantidad){ 
        // Devuelve  true = SI hay stock
        $sentencia = $consulta->prepare("SELECT sum(CANTIDAD) total from almacena 
                                        WHERE ID_PRODUCTO = :producto
                                        group by ID_PRODUCTO;");
        $sentencia->bindParam(':producto',$producto);
        $sentencia->execute();

        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo

        if ($resultado[0]["total"] < $cantidad){
            echo "<h3 style=\"color:red\">No hay STOCK <br>):</h3>";
            $cantidad = false;
        }else{
            echo ">>>>>>>>>> Si hay Stock <br>";
            $cantidad = true;
        }

        $consulta = null;
        return $cantidad;
    }

    function guardar_compra($consulta,$dni,$id_producto,$unidades,$fechaCom){ 
        // Pide el ID y la localidad, e inserta el nuevo almacen en la BD 
        $sentencia = $consulta->prepare("INSERT into compra (NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES) 
                                        values (:dni,:id_producto,:fechaCom,:unidades)");
        $sentencia->bindParam(':dni',$dni);
        $sentencia->bindParam(':id_producto',$id_producto);
        $sentencia->bindParam(':fechaCom',$fechaCom);
        $sentencia->bindParam(':unidades',$unidades);
        $sentencia->execute();// ejecuta la sentencia
        $consulta = null;
    }

    function restar_productos($consulta,$cantidad,$producto){ 
        // 0. Saca los IDs de todos los almacenes
        $sentencia = $consulta->prepare("select NUM_ALMACEN from almacen order by NUM_ALMACEN;");
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); 
        $almacenes= array_column($sentencia->fetchAll(),"NUM_ALMACEN"); // guardar los IDs de los Almacenes
        // 1. Selecciona un primer almacen 
        // 2. quita los productos del almacen: 
        //      a) NO HAY SUFICIENTE: quita todo
        //      b) SI HAY SUFICIANTE: quita lo justo y necesario
        $alma_actual = 0; // almacen actual
        $productos_restantes = $cantidad; //porductos que hay sacar sacando de uno o varios almacenes
        do {
            $sentencia = $consulta->prepare("select CANTIDAD from almacena where NUM_ALMACEN = :alma_actual && id_producto = :producto;");
            $sentencia->bindParam(':alma_actual',$almacenes[$alma_actual]);
            $sentencia->bindParam(':producto',$producto);
            $sentencia->execute();
            $sentencia->setFetchMode(PDO::FETCH_ASSOC); 
            $stock_alm= (array_column($sentencia->fetchAll(),"CANTIDAD")[0]);
            echo "-------stock almacen-----------";
            var_dump($stock_alm);
            echo "------------------";
            if(($stock_alm <= $cantidad )&&($stock_alm !==array())){
                /*
                delete from almacena
                where num_almacen = 1 && id_producto = 3;
                */
                $sentencia = $consulta->prepare("DELETE from almacena
                                                WHERE num_almacen = :alma_actual && id_producto = :producto;");
                $sentencia->bindParam(':alma_actual',$almacenes[$alma_actual]);
                $sentencia->bindParam(':producto',$producto);
                $sentencia->execute();
                $productos_restantes = $productos_restantes - $stock_alm;

            }else if(($stock_alm > $cantidad )&&($stock_alm !==array())){
                /*
                update almacena
                set cantidad = 7
                where num_almacen = 1 && id_producto = 1;
                */
                $sentencia = $consulta->prepare("UPDATE almacena
                                                SET cantidad = :productos_restantes
                                                WHERE num_almacen = :alma_actual && id_producto = :producto;");
                $sentencia->bindParam(':alma_actual',$almacenes[$alma_actual]);
                $sentencia->bindParam(':producto',$producto);
                $productos_restantes = $stock_alm - $productos_restantes;
                $sentencia->bindParam(':productos_restantes',$productos_restantes);
                $sentencia->execute();
            }else{
                // pasar al siguiente almacen
                $alma_actual ++;
            }
            
        }while ($productos_restantes > 0);
        // 3. Si (productos_restantes > 0) paso al siguiente almacen (vuelveo al paso 1.)

        
        $consulta = null;
    }

    function mostrar_compras($consulta){ 
        // Extrae todas los almacenes de la BD y las muestra por pantalla
        $sentencia = $consulta->prepare("select NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES from compra order by NIF;");
        $sentencia->execute();// ejecuta la sentencia
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll(); // guardar la sida de la select en un Array Asociativo
        echo "<h2>Compras</h2>";
        var_dump($resultado);
        $consulta = null;
    }
    
?>