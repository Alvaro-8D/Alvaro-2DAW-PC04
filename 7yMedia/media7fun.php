<?php
    function limpiar_campos($data) { // Evita la inyeccion de código
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function verTabla($tabla){ // Muestra Una Tabla
        $columna = "";
        foreach ($tabla as $key1 => $value) {
            $columna = $columna."<td style=\"padding: 5px;border-width: 2px;width:19px;\"> ".$value." </td>";
        }
        $cmd = "<table border=\"1px\" style=\"border-collapse: collapse;\">".
        "<tr style=\"padding: 5px;border-width: 2px;width:19px;\">".$columna."</tr></table>";

        print($cmd);
    }

    function generar_cartas(){
        for ($i=1; $i <= 10 ; $i++) {
            switch ($i) {
                case 8:
                    $j = "J";
                    break;
                case 9:
                    $j = "Q";
                    break;
                case 10:
                    $j = "K";
                    break;   
                default:
                    $j = $i;
                    break;
            } 
            $baraja[($j."C")] = "<img style=\"width: 70px;\" src=\"images/".$j."C.PNG\">";
            $baraja[($j."D")] = "<img style=\"width: 70px;\" src=\"images/".$j."D.PNG\">";
            $baraja[($j."P")] = "<img style=\"width: 70px;\" src=\"images/".$j."P.PNG\">";
            $baraja[($j."T")] = "<img style=\"width: 70px;\" src=\"images/".$j."T.PNG\">";
        }
        shuffle($baraja); // remueve y desordena la baraja
        verTabla($baraja);
        return $baraja;
    }









?>