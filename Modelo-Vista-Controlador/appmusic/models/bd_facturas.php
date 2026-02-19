<?php
    function recuperar_facturas($id_cliente,$fecha1,$fecha2){
        // Saca los datos del cliente y se los envia al contolador para pueda crear las cookies
        $sentencia = $GLOBALS['conexion']->prepare("SELECT Customerid, InvoiceId, InvoiceDate, BillingAddress, BillingCity, 
                                                    BillingState, BillingCountry, Total 
                                                    FROM invoice WHERE CustomerId = :id_cliente and 
                                                    InvoiceDate between :fecha1 and :fecha2
                                                    order by InvoiceDate desc;");
        $sentencia->bindParam(':id_cliente',$id_cliente);
        $sentencia->bindParam(':fecha1',$fecha1);
        $sentencia->bindParam(':fecha2',$fecha2);
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
        $resultado=$sentencia->fetchAll();
        // Devuelve el historial de facturas
        return $resultado;
    }  

    /*
    SELECT Customerid, InvoiceId, InvoiceDate, BillingAddress, BillingCity, 
                                                    BillingState, BillingCountry, Total 
                                                    FROM invoice WHERE CustomerId = 7 and 
                                                    InvoiceDate between '2009-01-01' and '2027-01-01'
                                                    order by InvoiceDate desc;
    */
    
?>