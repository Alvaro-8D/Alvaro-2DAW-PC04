<?php
    function limpiar_campos($data) { // Evita la inyeccion de código
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function verTabla($tabla,$foto = false){ // Muestra Una Tabla  
        $columna = "";
        foreach ($tabla as $key1 => $value) {
            if($foto){ // aquí muestra la foto de las cartas
                $columna = $columna."<td style=\"padding: 5px;border-width: 2px;width:19px;\"> ".mostrar_carta($value)." </td>";
            }else{ //aqui solo muestra los valores de la tabla
                $columna = $columna."<td style=\"padding: 5px;border-width: 2px;width:19px;\"> ".$value." </td>";
            }
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
            $baraja[$i] = $j."C";
            $baraja[$i+10] = $j."D";
            $baraja[$i+20] = $j."P";
            $baraja[$i+30] = $j."T";
        }
        shuffle($baraja); // remueve y desordena la baraja
        return $baraja;
    }

    function mostrar_carta($nombreCarta){
        return "<img style=\"width: 70px;\" src=\"images/".$nombreCarta.".PNG\">";
    }

    function sumar_puntos($lista){
        $puntuacion = 0;
        foreach ($lista as $key => $value) {
            $recorte = substr($value,0,1);
            if ($recorte == "J"||$recorte == "Q"||$recorte == "K") {
                $j = 0.5;
            }
            else {
                $j = $recorte;
            }
            $puntuacion += $j;
        }
        return $puntuacion;
    }
    /* Descarta los jugadores con puntuación > 7.5 y saca todos los jugadores con la máxima puntuación */
    function sacar_ganadores($j1,$j2,$j3,$j4){ 
        $ganadores1 = array( "j1" => $j1["puntos"],"j2" => $j2["puntos"],"j3" => $j3["puntos"],"j4" => $j4["puntos"]);   
        foreach ($ganadores1 as $key => $value) {
            if ($value > 7.5) { unset($ganadores1[$key]);} // elimina jugadores con más de 7.5
        }
        if (empty($ganadores1) != 1) { // cuando hya 0 ganadores no rellena el array
            foreach ($ganadores1 as $key => $value) {
                if ($value == max($ganadores1)) {
                    $ganadores2[$key] = $value; 
                }      
            }
        }else{ $ganadores2 = "No hay ganadores";} 
        return $ganadores2;
    }





?>