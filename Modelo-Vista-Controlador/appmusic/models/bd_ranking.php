<?php
    function hacer_ranking($id_cliente){
        // Saca los datos del cliente y se los envia al contolador para pueda crear las cookies
        $sentencia = $GLOBALS['conexion']->prepare("SELECT Customerid, InvoiceId, InvoiceDate, BillingAddress, BillingCity, 
                                                    BillingState, BillingCountry, Total 
                                                    FROM invoice WHERE CustomerId = 7
                                                    order by InvoiceDate desc;");
        $sentencia->bindParam(':id_cliente',$id_cliente);
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll();
        // Devuelve el historial de facturas
        return $resultado;
    }
    
?>