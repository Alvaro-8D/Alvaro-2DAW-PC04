<?php
    function verTabla($tabla){ // Muestra Una Tabla
        $fila = ""; 
        foreach ($tabla as $key1 => $seccion) {
            $columna = "";
            foreach ($seccion as $key2 => $value) {
                $columna = $columna."<td style=\"padding: 5px;border-width: 2px;width:19px;\"> ".$value." </td>";
            }
            $fila = $fila."<tr style=\"padding: 5px;border-width: 2px;width:19px;\">".$columna."</tr>";
        }
        $cmd = "<table border=\"1px\" style=\"border-collapse: collapse;\">".$fila." </table>";

        print($cmd);
    }

    
?>
