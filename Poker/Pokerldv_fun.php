<?php    
    function limpiar_campos($data) { // Evita la inyeccion de código
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /* TRUNCAR */
    function truncar($num,$decimal = 0){
        return ((int) ($num*(pow(10,$decimal))))/(pow(10,$decimal));
    }

    function generar_cartas(){
        
        $baraja[0] = "1C1";
        $baraja[1] = "1C2";
        $baraja[2] = "1T1";
        $baraja[3] = "1T2";
        $baraja[4] = "1D1";
        $baraja[5] = "1D2";
        $baraja[6] = "1P1";
        $baraja[7] = "1P2";

        $baraja[8] = "JC1";
        $baraja[9] = "JC2";
        $baraja[10] = "JT1";
        $baraja[11] = "JT2";
        $baraja[12] = "JD1";
        $baraja[13] = "JD2";
        $baraja[14] = "JP1";
        $baraja[15] = "JP2";

        $baraja[16] = "QC1";
        $baraja[17] = "QC2";
        $baraja[18] = "QT1";
        $baraja[19] = "QT2";
        $baraja[20] = "QD1";
        $baraja[21] = "QD2";
        $baraja[22] = "QP1";
        $baraja[23] = "QP2";

        $baraja[24] = "KC1";
        $baraja[25] = "KC2";
        $baraja[26] = "KT1";
        $baraja[27] = "KT2";
        $baraja[28] = "KD1";
        $baraja[29] = "KD2";
        $baraja[30] = "KP1";
        $baraja[31] = "KP2";

        shuffle($baraja); // remueve y desordena la baraja
        return $baraja;
    }

    function calcular_puntuacion($jugador){
        $baraja["1"] = 0;
        $baraja["J"] = 0;
        $baraja["Q"] = 0;
        $baraja["K"] = 0;

        $cadena[0] = substr($jugador[0],0,1); // saca la carta
        $cadena[1] = substr($jugador[1],0,1); // saca la carta
        $cadena[2] = substr($jugador[2],0,1); // saca la carta
        $cadena[3] = substr($jugador[3],0,1); // saca la carta

        foreach ($cadena as $key => $value) {
            $baraja[$value] = $baraja[$value] + 1;    
        }

        if(max($baraja)== 4){
            $cadena = 4;
        }else if(max($baraja)== 3){
            $cadena = 3;
        }else if(max($baraja)== 2){
            $n2 = 0;
            foreach ($baraja as $key => $value) {  
                if($value == 2){
                    $n2 ++;
                }  
            }
            if ($n2 > 1) {
                $cadena = 2;
            } else {
                $cadena = 1;
            }
        }else{
            $cadena = 0;
        }
        return $cadena;
    }

    function detectar_ganadores($Ajugadores,$apuesta = false){
        $Ajugadores2 = $cadena = array();
        foreach ($Ajugadores as $key => $value) {
            array_push($Ajugadores2, $value["puntuacion"]);
        }
        $Ajugadores2 = max($Ajugadores2);
        foreach ($Ajugadores as $key => $value) {
            if($value["puntuacion"] == $Ajugadores2){
                array_push($cadena,$value["nombre"]);
            }
        }

        if($apuesta){ //devuelve si se ha ganado con un trio, poker, pareja o doble pareja
            $cadena = $Ajugadores2;
        }
        return $cadena;
    }

    function verResultado($premi_a_repartir,$nomGanadores,$Ajugadores){
        if (!is_numeric($premi_a_repartir)) {
            echo "<h2>",$nomGanadores," no se repartirán nada de dinero, pobrecillos</h2>";
        } else {
            echo "<h2>",$nomGanadores," se van a repartir un premio de ",$premi_a_repartir,"€</h2>";
        }

        foreach ($Ajugadores as $key => $value) {
            switch ($value["puntuacion"]) {
                    case 4:
                        $loqueSaca = "Poker";
                        break;
                    case 3:
                        $loqueSaca = "Trio";
                        break;
                    case 2:
                        $loqueSaca = "Doble Pareja";
                        break;
                    case 1:
                        $loqueSaca = "Pareja";
                        break;
                    default:
                        $loqueSaca = "NINGUNA carta igual";
                        break;
                }
            echo "<br><h4>",$value["nombre"],": Ha sacado ",$loqueSaca,"</h4>";
            verTabla($value["mano"],true);

        }
        
    }

    function verTabla($tabla,$foto = false){ // Muestra Una Tabla  
        $columna = "";
        foreach ($tabla as $key1 => $value) {
            if($foto){ // aquí muestra la foto de las cartas
                $columna = $columna."<td style=\"padding: 5px;border-width: 2px;width:19px;\"><img src=\"./images/".$value.".PNG\"></td>";
            }else{ //aqui solo muestra los valores de la tabla
                $columna = $columna."<td style=\"padding: 5px;border-width: 2px;width:19px;\"> ".$value." </td>";
            }
        }
        $cmd = "<table border=\"1px\" style=\"border-collapse: collapse;\">".
        "<tr style=\"padding: 5px;border-width: 2px;width:19px;\">".$columna."</tr></table>";

        print($cmd);  
    }



?>