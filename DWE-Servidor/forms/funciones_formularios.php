<?php
    function verTabla($tabla,$matriz=true){ // Muestra Una Tabla
        $fila = ""; 
        foreach ($tabla as $key1 => $seccion) {
            $columna = "";
            if($matriz){
                foreach ($seccion as $key2 => $value) {
                    $columna = $columna."<td style=\"padding: 5px;border-width: 2px;width:19px;\"> ".$value." </td>";
                }  
                $fila = $fila."<tr style=\"padding: 5px;border-width: 2px;width:19px;\">".$columna."</tr>";     
            }else{
                // NO FUNIONA: QUIERO QUE SE CREE UNA TABLA HORIZONTAL (NO VERTICAL)
                $columna = $columna."<td style=\"padding: 5px;border-width: 2px;width:19px;\"> ".$seccion." </td>";
                $fila = "<tr style=\"padding: 5px;border-width: 2px;width:19px;\">".$columna."</tr>";
            }
            
        }
        $cmd = "<table border=\"1px\" style=\"border-collapse: collapse;\">".$fila." </table>";

        print($cmd);
    }

    function limpiar_campos($data) { // Evita la inyeccion de código
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>